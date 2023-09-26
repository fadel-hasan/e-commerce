export default class querySelectorAllElements {
    static requestApi(url: string,functionSuccess:CallableFunction,functionFail:CallableFunction) {
        fetch(url)
        .then((result: Response) => {
            if (result.status == 200) {
                return result.json();
            } else {
                return { ok: false };
            }
        }).
        then(({ok}) => {
            if (ok == true) {
                functionSuccess();
            } else {
                functionFail();
            }
        });
    }
    static removeWithApi(nameClass: string, urlAttribute: string, idAttribute: string) {
        (document.querySelectorAll(`.${nameClass}`) as NodeListOf<HTMLElement>).forEach((element) => {
            let urlApi = document.querySelector('table.list')?.getAttribute(urlAttribute);
            element.addEventListener('click', () => {
                if (confirm('هل أنت متأكد أنك تريد الحذف، الرجاء عدم حظر هذه الرسالة')) {
                    var urlRequest = `${urlApi}?id=${element.getAttribute(idAttribute)}`
                    this.requestApi(urlRequest,() => element.parentElement?.parentElement?.remove(),() => "");
                }
            });
        })
    }
}
