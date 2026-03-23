function openInNewTab(url){
window.open(url, '_blank');
}

const leoElement = document.getElementById("leo");
for(var i=0; i<20; i++){
const brElement1 = document.createElement("br");
leoElement.appendChild(brElement1);
}

const paintingContentElement = document.getElementById("painting_content");
for(var i=0; i<10; i++){
const brElement2 = document.createElement("br");
paintingContentElement.appendChild(brElement2);
}