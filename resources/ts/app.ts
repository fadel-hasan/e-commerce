import '@fortawesome/fontawesome-free/js/all.min.js'
// import 'chart.js';
import Chart from 'chart.js/auto';
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
            if (this.window.innerWidth >= 463) {
                (this.document.querySelector('.dashboard') as HTMLDivElement).style.setProperty('width', 'calc(100% - 10rem)');
            }
        })
        navbarAdmin.addEventListener('mouseleave', () => {
            if (this.window.innerWidth >= 463) {
                (this.document.querySelector('.dashboard') as HTMLDivElement).style.setProperty('width', 'calc(100% - 4rem)');
            }
        })
    }
    let monthlyVistors = this.document.getElementById('monthlyVistors') as HTMLCanvasElement;
    if (monthlyVistors) {
        let monthlyVistors2d = monthlyVistors.getContext('2d') as CanvasRenderingContext2D;
        // monthlyVistors2d.fillRect()
        new Chart(monthlyVistors2d, {
            type: 'line',
            data: {
                labels: ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31", "32"],
                datasets: [
                    {
                        label: 'الزيارات',
                        data: ["1813", "8845", "2241", "390", "5496", "5962", "6164", "8212", "4024", "5842", "6318", "2401", "3581", "7885", "5938", "3170", "465", "7589", "8698", "5490", "9032", "9666", "9453", "151", "3393", "6734", "2433", "9874", "6246", "3267", "9870", "2254"],
                        borderWidth: 2,
                    },
                ],
            },
            options: {
                maintainAspectRatio: false,
            }
        });
    }
});