import '@fortawesome/fontawesome-free/js/all.min.js'
import { Chart, ChartType } from 'chart.js/auto';
import {default as LoopElements} from './queryAllElements';
type canvasDatas = {
    id: string,
    type: ChartType,
    data: string,
    title: string,
    labels: string
}
type resultRequestProductes = {
    image: string,
    title:string,
    des:string,
    category:string,
    link:string,
    linkCategory:string,
}
declare var canvasData: Array<canvasDatas>;
window.addEventListener('load', function () {
    LoopElements.loopClick('#iconSearch',() => {
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
    // Close Alerts
    LoopElements.loopClick('.alert',(divAlert:HTMLElement) => {
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
    });
    // Response Web For Admin
    let navbarLeft = this.document.getElementById('navbarLeft') as HTMLDivElement;
    if (navbarLeft) {
        navbarLeft.addEventListener('mouseenter', () => {
            if (this.window.innerWidth >= 463) {
                (this.document.querySelector('.dashboard') as HTMLDivElement).style.setProperty('width', 'calc(100% - 10rem)');
            }
        })
        navbarLeft.addEventListener('mouseleave', () => {
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
    // Edit Product
    LoopElements.loopClick('.edit',(editForm:HTMLElement) => {
        var elementTableThis = editForm.parentElement?.parentElement as HTMLTableRowElement;
        (this.document.getElementById('title') as HTMLInputElement).value = elementTableThis.children[1].innerHTML;
        (this.document.getElementById('slug') as HTMLInputElement).value = elementTableThis.children[2].innerHTML;
        (this.document.getElementById('id') as HTMLInputElement).value = elementTableThis.children[0].innerHTML;
        var priceNew = this.document.getElementById('price') as HTMLInputElement;
        if (priceNew) {
            priceNew.value = elementTableThis.children[3].innerHTML.replace('$', '');
        }
    });
    // Config footer with css
    var height = this.document.body.offsetHeight;
    if (height < this.window.innerHeight) {
        (this.document.getElementById('footer') as HTMLDivElement).style.position = 'fixed';
        this.document.body.classList.add('non-height');
    }
    // View Password
    LoopElements.loopClick('.icon-eye',(el:HTMLElement) => {
        var input = ((el.parentElement as HTMLDivElement).querySelector('input') as HTMLInputElement);
        (input.type == 'password') ? input.type = 'text' : input.type = 'password';
    })
    // Remove Admin
    LoopElements.removeWithApi('remove-admin','data-url-remove','data-delete');
    // addMore
    let numberAddMore = 0;
    let moreHtmlAdd = this.document.getElementById('more') as HTMLDivElement;
    var htmlElementInputMore = '';
    if (moreHtmlAdd) {
        LoopElements.loopClick('#addMore',() => {
            numberAddMore++;
            htmlElementInputMore = `<label class="text font-bold cursor-pointer" for="name#${numberAddMore}">التطويرة #${numberAddMore}:</label>
            <input type="text" name="name#${numberAddMore}" id="name#${numberAddMore}" placeholder="التطويرة ${numberAddMore}">
            <label class="text font-bold cursor-pointer" for="price#${numberAddMore}">سعرها :</label>
            <input type="number" name="price#${numberAddMore}" id="price#${numberAddMore}" placeholder="20$" dir="ltr">
            <hr>`;
            moreHtmlAdd.innerHTML += htmlElementInputMore;
        });
    }
    // moreProductsClick
    let moreProductsClick = this.document.getElementById('moreProducts') as HTMLButtonElement;
    let numberPageProducts = 0;
    if (moreProductsClick) {
        let urlMoreProducts = this.document.getElementById('products')?.getAttribute('data-url-products');
        let htmlProductInsert = '';
        let spanSpiner = moreProductsClick.childNodes[1] as HTMLSpanElement;
        moreProductsClick.addEventListener('click',() => {
            numberPageProducts++;
            spanSpiner.classList.remove('hidden')
            LoopElements.requestApi(`${urlMoreProducts}?page=${numberPageProducts}`,(result:any) => {
                var resultProducts:Array<resultRequestProductes> = result.result;
                htmlProductInsert = '';
                resultProducts.forEach((product) => {
                    htmlProductInsert += `
                    <article>
                    <div class="img">
                        <a href="${product.link}">
                            <img src="${product.image}" alt="${product.title}" loading="lazy">
                        </a>
                    </div>
                    <div class="content">
                        <a href="${product.link}"><h3>${product.title}</h3></a>
                        <p>${product.des}</p>
                        <a href="${product.link}" class="button-blue">المزيد من المعلومات</a>
                    </div>
                    <a class="category" href="${product.linkCategory}">${product.category}</a>
                </article>
                    `;
                });
                (this.document.querySelector('.products') as HTMLDivElement).innerHTML += htmlProductInsert;
                spanSpiner.classList.add('hidden');
            },() => {
                console.error("error in your network")
                spanSpiner.classList.add('hidden');
            });
        })
    }
});
