import '@fortawesome/fontawesome-free/js/all.min.js'
// import 'chart.js';
import { Chart, ChartType } from 'chart.js/auto';
type canvasDatas = {
    id: string,
    type: ChartType,
    data: string,
    title: string,
    labels: string
}
declare var canvasData: Array<canvasDatas>;
window.addEventListener('load', function () {
    let iconSearch = document.getElementById('iconSearch') as HTMLSpanElement;
    iconSearch.addEventListener('click', (el: MouseEvent) => {
        let inputSearch = document.getElementById('inputSearch') as HTMLInputElement;
        if (inputSearch.value.length > 0) {
            window.location.href = `${window.location.origin}/search/${inputSearch.value}`
        }
    })
    let authPage = this.document.querySelector('form.auth') as HTMLFormElement;
    // Chek inputs
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
    // Close Alerts
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
    // Response Web For Admin
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
    // Add Chart With Chart.js
    if (typeof canvasData !== 'undefined') {
        let canvaElemnt;
        canvasData.forEach((canvasData: canvasDatas) => {
            console.log(canvasData)
            canvaElemnt = this.document.getElementById(canvasData.id) as HTMLCanvasElement;
            if (canvaElemnt) {
                let monthlyVistors2d = canvaElemnt.getContext('2d') as CanvasRenderingContext2D;
                new Chart(monthlyVistors2d, {
                    type: canvasData.type,
                    data: {
                        labels: JSON.parse(canvasData.labels),
                        datasets: [
                            {
                                label: canvasData.title,
                                data: JSON.parse(canvasData.data),
                                borderWidth: 2,
                            },
                        ],
                    },
                    options: {
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            }
                        }
                    },
                });
            }
        });
    }
    let inputFile = this.document.getElementById('file') as HTMLInputElement;
    let filePhoto = this.document.getElementById('filePhoto') as HTMLInputElement
    // Upload File, maby change this
    if (inputFile) {
        inputFile.addEventListener('change', (el) => {
            var explode = inputFile.value.split("\\");
            filePhoto.value = explode[(explode.length - 1)];
            if (/^[A-Za-z]+/.test(explode[(explode.length - 1)])) {
                filePhoto.style.direction = 'ltr';
            } else {
                filePhoto.style.direction = 'rtl';
            }
        })
        filePhoto.addEventListener('click', () => {
        });
    }
    let editForms = this.document.querySelectorAll('.edit') as NodeListOf<HTMLSpanElement>;
    // Edit Product
    editForms.forEach((editForm: HTMLSpanElement) => {
        editForm.addEventListener('click', () => {
            var elementTableThis = this.document.querySelector(`tr[data-row="${editForm.getAttribute('data-id')}"]`) as HTMLTableRowElement;
            (this.document.getElementById('title') as HTMLInputElement).value = elementTableThis.children[1].innerHTML;
            (this.document.getElementById('slug') as HTMLInputElement).value = elementTableThis.children[2].innerHTML;
            (this.document.getElementById('id') as HTMLInputElement).value = elementTableThis.children[0].innerHTML;
            var priceNew = this.document.getElementById('price') as HTMLInputElement;
            if (priceNew) {
                priceNew.value = elementTableThis.children[3].innerHTML.replace('$', '');
            }
        });
    });
    // Config footer with css
    var height = this.document.body.offsetHeight;
    if (height < this.window.innerHeight) {
        (this.document.getElementById('footer') as HTMLDivElement).style.position = 'fixed';
        this.document.body.classList.add('non-height');
    }
    // View Password
    (this.document.querySelectorAll('.icon-eye') as NodeListOf<HTMLElement>).forEach((el) => {
        el.addEventListener('click',(event:MouseEvent) => {
            var input = ((el.parentElement as HTMLDivElement).querySelector('input') as HTMLInputElement);
            (input.type == 'password') ? input.type = 'text' : input.type = 'password';
        })
    });
    // Remove Admin
    (this.document.querySelectorAll('.remove-admin') as NodeListOf<HTMLButtonElement>).forEach((button) => {
        let urlApi  = this.document.querySelector('table.list')?.getAttribute('data-url-remove');
        button.addEventListener('click',() => {
            if (urlApi == null) {
                urlApi = '';
            }
            console.log(urlApi);
            this.fetch(`${urlApi}?id=${button.getAttribute('data-delete')}`)
            .then((result:Response) => {
                if (result.status == 200) {
                    return result.json();
                } else {
                    return {ok:false};
                }
            }).
            then(({ok}) => {
                if (ok == true) {
                    button.parentElement?.parentElement?.remove();
                }
            });
        });
    })
});
