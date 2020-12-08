window.addEventListener('load', () => { //when page loads add all listeners to elements
    if (document.getElementById("index"))
        shutPanel(); //shut panel initially 

    if (document.getElementById("toggleMenu"))
        document.getElementById("toggleMenu").addEventListener("click", () => toggleMenu());
    if (document.getElementById("togglePass"))
        document.getElementById("togglePass").addEventListener("click", () => togglePassword());
});

function togglePassword() {
    let pass = document.getElementsByName("pass")[0];
    pass.type = pass.type == "password" ? "text" : "password";
}

function toggleMenu() {
    // event.preventDefault();
    let menu = document.getElementById("sidepanel");
    if (menu.style.width == "0px")
        openPanel();
    else
        shutPanel();
}

function openPanel() {
    if (document.getElementById("sidepanel"))
        document.getElementById("sidepanel").style.width = "230px";
    /*let text = document.getElementsByClassName("menu_item");
    for(let i = 0; i < text.length; i++)
        text[i].style.visibility = "visible";
    document.getElementById("usericon").style.paddingLeft = "10px";*/
}

function shutPanel() {
    if (document.getElementById("sidepanel"))
        document.getElementById("sidepanel").style.width = "0px";
    /*let text = document.getElementsByClassName("menu_item");
    for(let i = 0; i < text.length; i++)
        text[i].style.visibility = "hidden";
    document.getElementById("usericon").style.paddingLeft = "5px";*/
}