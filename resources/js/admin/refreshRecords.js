import { getRecords } from "../utils/queries"

export async function refreshRecords(){
    const table = document.querySelector('.table-records')
    const loader = document.querySelector('.loader')
    const totalRecords = document.querySelector('.total-records')

    try{
        table.style.opacity = 0.5
        loader.style.display = 'inline-block'

        const records = await getRecords()
        table.innerHTML = records.html
        totalRecords.textContent = records.total
    }catch(error){
        throw error
    }finally{
        table.style.opacity = 1
        loader.style.display = 'none'
    }
}