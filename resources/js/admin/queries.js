export async function getHtmlTable(){
    try{
        const response = await axios.get(window.location.href)
        return await response.data
    }catch(error){
        throw error.response.data.errors
    }
}