function toggleMenu() {
    let menu = document.getElementById("dynamicMenu");
    if (menu.style.display === "none" || menu.style.display === "") {
        menu.style.display = "block";
    } else {
        menu.style.display = "none";
    }
}

function previewText() {
    let input = document.getElementById("liveInput").value;
    document.getElementById("previewArea").innerText = input;
}