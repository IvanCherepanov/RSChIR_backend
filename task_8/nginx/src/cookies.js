var btn = document.getElementById("theme-button");
var stylesheetLink = document.getElementById("theme-link");
let currentTheme = getCookie("theme");
const lightThemeLink = "http://localhost:8006/main.css"
const darkThemeLink = "http://localhost:8006/dark.css"

if (currentTheme === "dark") {
    stylesheetLink.href = darkThemeLink
} else {
    stylesheetLink.href = lightThemeLink
}

btn.addEventListener("click", function () { ChangeTheme(); });

function ChangeTheme()
{

    if(currentTheme == "light")
    {
        currTheme = darkThemeLink;
        currentTheme = "dark";
    }
    else
    {
        currTheme = lightThemeLink;
        currentTheme = "light";
    }
    setCookie("theme", currentTheme);//new Date(Date.now() + 60);
    location.reload();
}

const lang_btn = document.getElementById("lang-button");
let currentLanguage = getCookie("lang");

lang_btn.addEventListener("click", function () {
    if (currentLanguage === "ru") {
        currentLanguage = "en";
    } else {
        currentLanguage = "ru";
    }
    console.log(currentLanguage);
    setCookie("lang", currentLanguage);
    location.reload();
})

const fav_btn = document.getElementById("fav-button");
var favLink = document.getElementById("fav-link");
let currentFav = getCookie("fav");

const favHP = "http://localhost:8006/img/hp.jpg"
const favWitcher = "http://localhost:8006/img/witch.jpg"

if (currentFav === "hp") {
     favLink.href = favHP
} else {
    favLink.href = favWitcher
}

fav_btn.addEventListener("click", function () {
    if (currentFav === "hp") {
        currentFav = favWitcher;
        currentFav = "witcher";
    } else {
        currentFav = favHP;
        currentFav = "hp";
    }
    console.log(currentFav);
    setCookie("fav", currentFav);
    location.reload();
})


function getCookie(name) {
    let matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
}

//аналог php функции
function setCookie(name, value, options = {}) {

    options = {
        path: '/',//Как правило, указывают в качестве пути корень path=/, чтобы наше куки было доступно на всех страницах сайта.
        ...options
    };

    //Чтобы помочь куки «пережить» закрытие браузера, мы можем установить значение опций expires
    if (options.expires instanceof Date) {
        options.expires = options.expires.toUTCString();
    }

    let updatedCookie = encodeURIComponent(name) + "=" + encodeURIComponent(value);

    for (let optionKey in options) {
        updatedCookie += "; " + optionKey;
        let optionValue = options[optionKey];
        if (optionValue !== true) {
            updatedCookie += "=" + optionValue;
        }
    }

    document.cookie = updatedCookie;
}