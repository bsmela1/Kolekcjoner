//funkcja getRandomInt zwraca losowe wartosci calkowite z zakresu od 0 do max-1
function getRandomInt(max) {
    return Math.floor(Math.random() * max);
}

//tablica kolorow ktore bede uzywal jako tlo do divov
let colors = ['#6b5b95', '#feb236', '#a75265', '#ff7b25'];
let main = document.getElementById("main");

//biore wszystkie obiekty a z maina do tablicy collections
let collections = main.querySelectorAll("a");

//dla kazdego obiektu a, zmieniam background-color na wylosowany kolor :)
collections.forEach(element => {
    let chosenColor = colors[getRandomInt(4)];
    element.style.backgroundColor = chosenColor;
});
