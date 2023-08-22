import '@fortawesome/fontawesome-free/js/all.min.js'
window.addEventListener('load', function () {
    let iconSearch = document.getElementById('iconSearch') as HTMLSpanElement;
    iconSearch.addEventListener('click', (el: MouseEvent) => {
        let inputSearch = document.getElementById('inputSearch') as HTMLInputElement;
        if (inputSearch.value.length > 0) {
            window.location.href = `${window.location.origin}/search/${inputSearch.value}`
        }
    })
    let authPage = this.document.querySelector('form.auth') as HTMLFormElement;
    if (authPage) {
        let inputEmailAuth = this.document.getElementById('email') as HTMLInputElement;
        let inputPassAuth = this.document.getElementById('password') as HTMLInputElement;
        let inputButtonAuth = this.document.getElementById('buttonAuth') as HTMLInputElement;
        function isChangeAuth() {
            let regExEmail = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g;
            if (inputEmailAuth.value.length != 0 && inputPassAuth.value.length >= 8 && regExEmail.test(inputEmailAuth.value)) {
                inputButtonAuth.removeAttribute('disabled');
            } else {
                if (!inputButtonAuth.getAttribute('disabled')) {
                    inputButtonAuth.setAttribute('disabled', '');
                }
            }
        }
        inputEmailAuth.addEventListener('input', isChangeAuth);
        inputPassAuth.addEventListener('input', isChangeAuth);
    }
    let divAlerts = document.querySelectorAll('.alert') as NodeListOf<HTMLDivElement>;
    if (divAlerts) {
        divAlerts.forEach((divAlert: HTMLDivElement) => {
            (divAlert.querySelector('.close-alert') as HTMLSpanElement).addEventListener('click', function () {
                var opacity = 100;
                var timeRemoveAlert = setInterval(() => {
                    opacity -= 10;
                    if (opacity == 0) {
                        divAlert.remove();
                        clearInterval(timeRemoveAlert)   
                    }
                    divAlert.style.opacity = opacity.toString() + '%';
                },30);
            })
        })
    }
})