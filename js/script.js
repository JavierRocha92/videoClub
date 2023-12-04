const signup = document.getElementById('signup')
const login = document.getElementById('login')
const login__button = document.getElementById('login__button')
const signup__button = document.getElementById('signup__button')
const container__forms = document.getElementById('container__forms')
const menu_icon = document.getElementById('menu_icon')
const user_icon = document.getElementById('user_icon')
const nav = document.getElementById('nav')



/**
 * funciton to change a form view by other depending ehich of them is on screen
 * 
 * @param {HTMLFormElement} form_1 
 * @param {HTMLFormElement} form_2 
 */
const exhangeForms = (form_1,form_2) => {
    form_1.classList.remove('form__rotate-appear')
    form_1.classList.add('form__rotate-desappear')
    setTimeout(() => {
        form_2.classList.remove('form__rotate-desappear')
        form_2.classList.add('form__rotate-appear')
    },400)
}
/**
 * funtion to detect which form is being pushed to call other funtions to show or hide froms
 * 
 * @param {event} event 
 */
const detectForm = (e) => {
    const form = e.parentElement.parentElement
    if(e.id === 'login__button' || e.id === 'signup__button'){
        if(form.id === 'signup')
        exhangeForms(signup,login)
        if(form.id === 'login')
        exhangeForms(login,signup)
    }
}

const checkElement = (event) => {
    const e = event.target
    if(e.classList.contains('icon'))
    hideForms()
    if(e.classList.contains('form__text'))
    detectForm(e)
    
}
/**
 * function to show container forms by update style to coatiner_form element
 */
const manageForms = () => {
    container__forms.style.display = 'block'
}
/**
 * function to hide container forms by update style to coatiner_form element
 */
const hideForms = () => {
    container__forms.style.display = 'none'
}

const exchangeMenu = () => {
    if(nav.style.display == 'none' || nav.style.display == '')
    nav.style.display = 'block'
    else
    nav.style.display = 'none'
}
//events

//event to catch a click on user icon from nav

user_icon.addEventListener('click',manageForms)

//event to catch a click on menu icon from nav

menu_icon.addEventListener('click',exchangeMenu)

//events to catcha a clikck on container_forms
container__forms.addEventListener('click',checkElement)