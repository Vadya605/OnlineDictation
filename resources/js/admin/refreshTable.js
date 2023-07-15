import { getHtmlTable } from "../queries"

const table = document.querySelector('.table-records')
const loader = document.querySelector('.loader')

export async function refreshTable(){
    try{
        table.style.opacity = 0.5
        loader.style.display = 'inline-block'

        const htmlTable = await getHtmlTable()
        table.innerHTML = htmlTable
    }catch(error){
        throw error
    }finally{
        table.style.opacity = 1
        loader.style.display = 'none'
    }
}