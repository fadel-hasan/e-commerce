import { ChartType } from 'chart.js/auto';
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
type coponReuestChek = {
    ok:boolean,
    discount:number
}
export {canvasDatas,resultRequestProductes,coponReuestChek}
