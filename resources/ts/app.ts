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
        let inputPassAuth = this.document.getElementById('email') as HTMLInputElement;
        let inputButtonAuth = this.document.getElementById('buttonAuth') as HTMLInputElement;
        let inputPassrepeatAuth = this.document.getElementById('repeatPassword') as HTMLInputElement;
        function isChangeAuth() {
            let regExEmail = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g;
            if (inputEmailAuth.value.length != 0 && inputPassAuth.value.length >= 8 && regExEmail.test(inputEmailAuth.value)) {
                if (inputPassrepeatAuth) {
                    if (inputPassrepeatAuth.value == inputPassAuth.value) {
                        inputButtonAuth.removeAttribute('disabled');
                    } else {
                        inputButtonAuth.setAttribute('disabled', '');
                    }
                } else {
                    inputButtonAuth.removeAttribute('disabled');
                }
            } else {
                if (!inputButtonAuth.getAttribute('disabled')) {
                    inputButtonAuth.setAttribute('disabled', '');
                }
            }
        }
        if (authPage.classList.length == 1) {
            inputPassAuth = this.document.getElementById('password') as HTMLInputElement;
            inputPassAuth.addEventListener('input', isChangeAuth);
            if (inputPassrepeatAuth) {
                inputPassrepeatAuth.addEventListener('input', isChangeAuth);
            }
        }
        inputEmailAuth.addEventListener('input', isChangeAuth);
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
                }, 30);
            })
        })
    }
    let navbarAdmin = this.document.getElementById('navbarAdmin') as HTMLDivElement;
    if (navbarAdmin) {
        navbarAdmin.addEventListener('mouseenter', () => {
            (this.document.querySelector('.dashboard') as HTMLDivElement).style.setProperty('width', 'calc(100% - 10rem)');
        })
        navbarAdmin.addEventListener('mouseleave', () => {
            (this.document.querySelector('.dashboard') as HTMLDivElement).style.setProperty('width', 'calc(100% - 4rem)');
        })
    }
})
