
// --- 1. PIN DEFINITIONS ---
const int IR_SENSOR_PIN = 12; // Proximity Sensor (RED)
const int BUZZER_PIN = 2;     // Buzzer Output
const int GAS_SENSOR_PIN = A0; // Gas Sensor (YELLOW)
const int VIBRATION_SENSOR_PIN = 7; // Tilt/Vibration Sensor (PURPLE)

// DHT Sensor Setup
#define DHT_DATA_PIN 8       
#define DHT_TYPE DHT11       
DHT dht(DHT_DATA_PIN, DHT_TYPE);

// RGB LED Pins
const int RED_PIN = 9;    
const int GREEN_PIN = 10;  
const int BLUE_PIN = 11;    

// --- 2. THRESHOLD CONSTANTS ---
const float TEMP_THRESHOLD = 30.0;   
const float HUMIDITY_THRESHOLD = 70.0; 
const int GAS_THRESHOLD = 600; 

// --- 3. TIMING VARIABLES (PULSING CYCLE LOGIC) ---
unsigned long lastPrintTime = 0; 
const long PRINT_INTERVAL = 3000; // 3 seconds print interval for SAFE readings

// Alarm Cycle Variables
unsigned long alarmCycleStartTime = 0; // Tracks the start of the 2-second cycle
const long PULSE_ON_DURATION = 1000;  // 1 second Pulse ON (Buzzer/LED)
const long PULSE_CYCLE_DURATION = 2000; // 2 seconds total cycle (1s ON + 1s OFF)

void setup() {
  pinMode(IR_SENSOR_PIN, INPUT);
  pinMode(BUZZER_PIN, OUTPUT);
  pinMode(VIBRATION_SENSOR_PIN, INPUT_PULLUP); 
  
  pinMode(RED_PIN, OUTPUT);
  pinMode(GREEN_PIN, OUTPUT);
  pinMode(BLUE_PIN, OUTPUT);

  Serial.begin(9600);
  Serial.println(">>> Multi-Condition Alarm System Activated (FINAL LOGIC) <<<");
  dht.begin();
  
  // Initialize outputs to OFF
  noTone(BUZZER_PIN); 
  analogWrite(RED_PIN, 0); analogWrite(GREEN_PIN, 0); analogWrite(BLUE_PIN, 0);
}

void loop() {
  
  // ****************** 1. SENSOR READINGS ******************
  float humidity = dht.readHumidity();
  float temperature = dht.readTemperature();
  int irStatus = digitalRead(IR_SENSOR_PIN);
  int gasValue = analogRead(GAS_SENSOR_PIN); 
  int vibrationStatus = digitalRead(VIBRATION_SENSOR_PIN); 

  if (isnan(humidity) || isnan(temperature)) {
    Serial.println("!!! ERROR: Failed to read DHT sensor !!!");
    return;
  }

  // ****************** 2. CONDITION CHECK ******************
  // *** FIXED: IR logic inverted since reading '1' is the safe state ***
  bool irCondition = (irStatus == LOW);        
  
  bool tempCondition = (temperature > TEMP_THRESHOLD); 
  bool humCondition = (humidity > HUMIDITY_THRESHOLD); 
  bool gasCondition = (gasValue > GAS_THRESHOLD); 
  bool vibrationCondition = (vibrationStatus == LOW); 

  bool anyAlarmCondition = irCondition || tempCondition || humCondition || gasCondition || vibrationCondition; 
  
  unsigned long currentTime = millis();

  // ****************** 3. PULSING ALARM LOGIC (1s ON / 1s OFF) ******************

  if (anyAlarmCondition) { 
    
    // --- Step A: Start/Restart the Alarm Cycle ---
    if (alarmCycleStartTime == 0 || (currentTime - alarmCycleStartTime >= PULSE_CYCLE_DURATION)) {
      alarmCycleStartTime = currentTime;
      Serial.println("\n--- Starting NEW Alarm Cycle (2s) ---");
    }
    
    // --- Step B: Determine if we are in the 1-second ON window ---
    if (currentTime - alarmCycleStartTime < PULSE_ON_DURATION) {
      
      tone(BUZZER_PIN, 4200); 
      analogWrite(RED_PIN, 0); analogWrite(GREEN_PIN, 0); analogWrite(BLUE_PIN, 0);
      
      // PRIORITY LOGIC: 1. IR (RED), 2. VIB (PURPLE), 3. GAS (YELLOW), 4. TEMP (GREEN), 5. HUM (BLUE)
      
      if (irCondition) { // 1st Priority (RED)
        analogWrite(RED_PIN, 255);
        Serial.print("!!! ALARM ACTIVE: Proximity (RED) | ");
      } else if (vibrationCondition) { // 2nd Priority (PURPLE)
        analogWrite(RED_PIN, 255); analogWrite(BLUE_PIN, 255); 
        Serial.print("!!! ALARM ACTIVE: Tilt/Vibration (PURPLE) | ");
      } else if (gasCondition) { // 3rd Priority (YELLOW)
        analogWrite(RED_PIN, 255); analogWrite(GREEN_PIN, 255); 
        Serial.print("!!! ALARM ACTIVE: Gas Leak (YELLOW): "); Serial.print(gasValue); Serial.print(" | ");
      } else if (tempCondition) { // 4th Priority (GREEN)
        analogWrite(GREEN_PIN, 255);
        Serial.print("!!! ALARM ACTIVE: High Temp (GREEN): "); Serial.print(temperature); Serial.print("C | ");
      } else if (humCondition) { // 5th Priority (BLUE)
        analogWrite(BLUE_PIN, 255);
        Serial.print("!!! ALARM ACTIVE: High Humidity (BLUE): "); Serial.print(humidity); Serial.print("% | ");
      }
      Serial.println("PULSE ON (1s)");
      
    } else {
      // --- Step C: Silent Gap (1-second OFF window) ---
      noTone(BUZZER_PIN);
      analogWrite(RED_PIN, 0); analogWrite(GREEN_PIN, 0); analogWrite(BLUE_PIN, 0);
      
      // Print this message only once per silent gap
      if (currentTime - alarmCycleStartTime < PULSE_CYCLE_DURATION - 900) { 
        Serial.println("--- Silent Gap (1s OFF) ---");
      }
    }
    
  } else {
    // ****************** 4. SAFE STATE AND MONITORING ******************
    
    // Reset cycle timer and ensure outputs are off
    alarmCycleStartTime = 0; 
    noTone(BUZZER_PIN);
    analogWrite(RED_PIN, 0); analogWrite(GREEN_PIN, 0); analogWrite(BLUE_PIN, 0);
    
    // Print readings every 3 seconds
    if (currentTime - lastPrintTime >= PRINT_INTERVAL) {
      Serial.print("SAFE: VIB: "); Serial.print(vibrationStatus); Serial.print(" | ");
      Serial.print("Gas: "); Serial.print(gasValue); Serial.print(" | ");
      Serial.print("Temp: "); Serial.print(temperature); Serial.print(" C | ");
      Serial.print("Humidity: "); Serial.print(humidity); Serial.println(" %");
      lastPrintTime = currentTime; 
    }
  }
}