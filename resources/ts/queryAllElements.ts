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
        let urlApi = document.querySelector('table.list')?.getAttribute(urlAttribute);
        this.loopClick(`.${nameClass}`,(element:HTMLElement) => {
            if (confirm('هل أنت متأكد أنك تريد الحذف، الرجاء عدم حظر هذه الرسالة')) {
                var urlRequest = `${urlApi}?id=${element.getAttribute(idAttribute)}`
                this.requestApi(urlRequest,() => element.parentElement?.parentElement?.remove(),() => "");
            }
        });
    }
    static loopClick(elementName:string,funcationCall:CallableFunction) {
        (document.querySelectorAll(elementName) as NodeListOf<HTMLElement>).forEach((element) => element.addEventListener('click',() => funcationCall(element)));
    }
}
