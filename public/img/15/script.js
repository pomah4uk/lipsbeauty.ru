
//попедение формы
function handleFormSubmit(e) {
  e.preventDefault();

  const title = document.getElementById("title").value;
  const genre = document.getElementById("genre").value;
  const releaseYear = document.getElementById("releaseYear").value;
  const isWatched = document.getElementById("isWatched").checked;

  const film = {
    title: title,
    genre: genre,
    releaseYear: releaseYear,
    isWatched: isWatched,
  };

  addFilm(film);
}

//запрос на добавление фильма
async function addFilm(film) {
  await fetch("https://sb-film.skillbox.cc/films", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      email: "pomah4uk@gmail.com",
    },
    body: JSON.stringify(film),
  });
  renderTable();
}

//Удаление всех фильмов
async function deleteAllFilm() {
  await fetch("https://sb-film.skillbox.cc/films/", {
    method: "DELETE",
    headers: {
      email: "pomah4uk@gmail.com"
    }
  })
  renderTable();
}

//Удаление фильма по ID
async function deleteFilm(id) {
  await fetch(`https://sb-film.skillbox.cc/films/${id}`, {
    method: "DELETE",
    headers: {
      email: "pomah4uk@gmail.com"
    }
  })
  renderTable();
}


//запрос всех фильмов и рендер таблицы
async function renderTable() {
  const filmsResponse = await fetch("https://sb-film.skillbox.cc/films", {
    headers: {
      email: "pomah4uk@gmail.com",
    },
  });
  const films = await filmsResponse.json();

  const filmTableBody = document.getElementById("film-tbody");

  // Clear table body first
  filmTableBody.innerHTML = "";

  // Then add new rows
  films.forEach((film) => {
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

//отправка форма при нажатии на кнопку
document
  .getElementById("film-form")
  .addEventListener("submit", handleFormSubmit);

//событие нажатие на удалить всё
document
  .querySelector(".btnDelAll")
  .addEventListener("click", () => deleteAllFilm());


//Рендер таблицы при открытии страницы
renderTable();