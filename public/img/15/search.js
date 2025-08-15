const searchTitle = document.querySelector("#search-title")
const searchGenre = document.querySelector("#search-genre")
const searchYear = document.querySelector("#search-year")
const search = document.querySelector("#search")



search.addEventListener('change', function(){
    if (search.value == 'title') {
        searchTitle.disabled = false;
        searchGenre.disabled = true;
        searchGenre.value = "";
        searchYear.disabled = true;
        searchYear.value = "";
        renderTable();
    }
    if (search.value == 'genre') {
        searchTitle.disabled = true;
        searchTitle.value = "";
        searchGenre.disabled = false;
        searchYear.disabled = true;
        searchYear.value = "";
        renderTable();
    }
    if (search.value == 'releaseYear') {
        searchTitle.disabled = true;
        searchTitle.value = "";
        searchGenre.disabled = true;
        searchGenre.value = "";
        searchYear.disabled = false;
        renderTable();
    }
})

searchTitle.addEventListener('input', function(){
    searchTitleFilm(searchTitle.value);
});

searchGenre.addEventListener('input', function(){
    searchGenreFilm(searchGenre.value);
});

searchYear.addEventListener('input', function(){
    searchYearFilm(searchYear.value);
});


function renderSearch(param){
    const filmTableBody = document.getElementById("film-tbody");

    // Clear table body first
    filmTableBody.innerHTML = "";
  
    // Then add new rows
    param.forEach((film) => {
      const row = document.createElement("tr");
      row.innerHTML = `
        <td>${film.title}</td>
        <td>${film.genre}</td>
        <td>${film.releaseYear}</td>
        <td>${film.isWatched ? "Да" : "Нет"}</td>
        <td><button class="btn btnDel" id="${film.id}">Удалить</button></td>`;
      filmTableBody.appendChild(row);
    });
    const btnsDel = document.querySelectorAll(".btnDel");
    btnsDel.forEach(btnDel => {
      btnDel.addEventListener('click', () => deleteFilm(btnDel.id))
    })
}


//поиск по названию
async function searchTitleFilm(param) {
    const films = await fetch("https://sb-film.skillbox.cc/films", {
        headers: {
            email: "pomah4uk@gmail.com"
        }
    })
    const filmsArr = await films.json();
    const filteredFilmsArr = filmsArr.filter(film =>
        film.title.toLowerCase().includes(param.toLowerCase())
    );
    renderSearch(filteredFilmsArr);
}

//поиск по жанру
async function searchGenreFilm(param) {
    const films = await fetch("https://sb-film.skillbox.cc/films", {
        headers: {
            email: "pomah4uk@gmail.com"
        }
    })
    const filmsArr = await films.json();
    const filteredFilmsArr = filmsArr.filter(film =>
        film.genre.toLowerCase().includes(param.toLowerCase())
    );
    renderSearch(filteredFilmsArr);
}

//поиск по году
async function searchYearFilm(param) {
    const films = await fetch("https://sb-film.skillbox.cc/films", {
        headers: {
            email: "pomah4uk@gmail.com"
        }
    })
    const filmsArr = await films.json();
    const filteredFilmsArr = filmsArr.filter(film =>
        film.releaseYear.includes(param)
    );
    renderSearch(filteredFilmsArr);
}