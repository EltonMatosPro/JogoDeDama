function checkForChallenge() {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "php/check_challenge.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            if (xhr.responseText === "start_game") {
                window.location.href = "play.php"; // Redirecionar para a página do jogo
            }
        }
    };
    xhr.send();
}

setInterval(checkForChallenge, 3000); // Checar a cada 3 segundos
