const title = document.querySelector("#title");
const genre = document.querySelector("#genre");
const releaseYear = document.querySelector("#releaseYear");
const warningTitle = document.querySelector(".warning-title");
const warningGenre = document.querySelector(".warning-genre");
const warningYear = document.querySelector(".warning-year");

if (title.value == "") {
    warningTitle.textContent = "Заполните название"
}

if (genre.value == "") {
    warningGenre.textContent = "Заполните жанр"
}

if (releaseYear.value == "") {
    warningYear.textContent = "Введите год"
}