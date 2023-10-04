import '@fortawesome/fontawesome-free/js/all.min.js'
import { Chart } from 'chart.js/auto';
import { default as LoopElements } from './queryAllElements';
import { canvasDatas, resultRequestProductes } from './type';
declare var canvasData: Array<canvasDatas>;
window.addEventListener('load', function () {
    LoopElements.loopClick('#iconSearch', () => {
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
    LoopElements.loopClick('.alert', (divAlert: HTMLElement) => {
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
    // Edit Product
    LoopElements.loopClick('.edit', (editForm: HTMLElement) => {
        var elementTableThis = editForm.parentElement?.parentElement as HTMLTableRowElement;
        (this.document.getElementById('title') as HTMLInputElement).value = elementTableThis.children[1].innerHTML;
        (this.document.getElementById('slug') as HTMLInputElement).value = elementTableThis.children[2].innerHTML;
        (this.document.getElementById('id') as HTMLInputElement).value = elementTableThis.children[0].innerHTML;
        var priceNew = this.document.getElementById('price') as HTMLInputElement;
        if (priceNew) {
            priceNew.value = elementTableThis.children[3].innerHTML.replace('$', '');
        }
    });
    // View Password
    LoopElements.loopClick('.icon-eye', (el: HTMLElement) => {
        var input = ((el.parentElement as HTMLDivElement).querySelector('input') as HTMLInputElement);
        (input.type == 'password') ? input.type = 'text' : input.type = 'password';
    })
    // Remove Admin
    LoopElements.removeWithApi('remove-admin', 'data-url-remove', 'data-delete');
    // addMore
    let moreHtmlAdd = this.document.getElementById('more') as HTMLDivElement;
    var htmlElementInputMore = '';
    if (moreHtmlAdd) {
        let numberAddMore = Number(moreHtmlAdd.getAttribute('data-count')) ?? 0;
        LoopElements.loopClick('#addMore', () => {
            numberAddMore++;
            htmlElementInputMore = `<div class="flex flex-col"><label class="text font-bold cursor-pointer" for="name#${numberAddMore}">التطويرة #${numberAddMore}:</label>
            <input type="text" name="name#${numberAddMore}" id="name#${numberAddMore}" placeholder="التطويرة ${numberAddMore}">
            <label class="text font-bold cursor-pointer" for="price#${numberAddMore}">سعرها :</label>
            <input type="number" name="price#${numberAddMore}" id="price#${numberAddMore}" placeholder="20$" dir="ltr">
            <span class="button-red mb-3">حذف التطويرة</span><hr></div>`;
            moreHtmlAdd.innerHTML += htmlElementInputMore;
            LoopElements.removeMoreProduct(() => numberAddMore--);
        });
        LoopElements.removeMoreProduct(() => numberAddMore--);
    }
    // moreProductsClick
    let moreProductsClick = this.document.getElementById('moreProducts') as HTMLButtonElement;
    let numberPageProducts = 1;
    if (moreProductsClick) {
        let urlMoreProducts = this.document.getElementById('products')?.getAttribute('data-url-products');
        let htmlProductInsert = '';
        let spanSpiner = moreProductsClick.childNodes[1] as HTMLSpanElement;
        moreProductsClick.addEventListener('click', () => {
            numberPageProducts++;
            spanSpiner.classList.remove('hidden')
            LoopElements.requestApi(`${urlMoreProducts}?page=${numberPageProducts}`, (result: any) => {
                var resultProducts: Array<resultRequestProductes> = result.result;
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
                if (htmlProductInsert === '') {
                    moreProductsClick.remove();
                }
                spanSpiner.classList.add('hidden');
            }, () => {
                spanSpiner.classList.add('hidden');
                moreProductsClick.remove();
            });
        })
    }
    // img-profile
    let dropDaown = false;
    let dropDaownDiv = this.document.querySelector('.dropdaown') as HTMLDivElement;
    LoopElements.loopClick('#img-profile', () => {
        if (dropDaown) {
            dropDaownDiv.classList.remove('active');
            var timeRemoveAlert = setInterval(() => {
                    clearInterval(timeRemoveAlert);
                    dropDaownDiv.classList.remove('flexElement');
            }, 300);
            dropDaown = false;
        } else {
            dropDaownDiv.classList.add('flexElement');
            var timeRemoveAlert = setInterval(() => {
                dropDaownDiv.classList.add('active');
                clearInterval(timeRemoveAlert)
            }, 10);
            dropDaown = true;
        }
    });
    // icon-past
    LoopElements.loopClick('.icon-past',() => {
        var copyText = document.getElementById("copyLink") as HTMLInputElement;
        copyText.select(); // Select the text field
        copyText.setSelectionRange(0, 99999); // For mobile devices
        navigator.clipboard.writeText(copyText.value); // Copy the text inside the text field
        alert("تم النسخ");
    })
});
