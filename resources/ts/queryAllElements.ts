export default class querySelectorAllElements {
    // Request Any API
    static requestApi(url: string,functionSuccess:CallableFunction,functionFail:CallableFunction) {
        fetch(url)
        .then((result: Response) => (result.status == 200) ? result.json() : { ok: false })
        .then((result) => (result.ok == true) ? functionSuccess(result) : functionFail());
    }
    // Remove data in databases with API
    static removeWithApi(nameClass: string, urlAttribute: string, idAttribute: string) {
        let urlApi = document.querySelector('table.list')?.getAttribute(urlAttribute);
        this.loopClick(`.${nameClass}`,(element:HTMLElement) => {
            if (confirm('هل أنت متأكد أنك تريد الحذف، الرجاء عدم حظر هذه الرسالة')) {
                var urlRequest = `${urlApi}?id=${element.getAttribute(idAttribute)}`
                this.requestApi(urlRequest,(res:any) => element.parentElement?.parentElement?.remove(),() => "");
            }
        });
    }
    // Loop Elements for click any element
    static loopClick(elementName:string,funcationCall:CallableFunction) {
        (document.querySelectorAll(elementName) as NodeListOf<HTMLElement>)?.forEach((element) => element.addEventListener('click',() => funcationCall(element)));
    }
    static removeMoreProduct(fun:CallableFunction) {
        this.loopClick('.flex span.button-red',(element:HTMLElement) => {
            element.parentElement?.remove();
            fun();
        });
    }
}
