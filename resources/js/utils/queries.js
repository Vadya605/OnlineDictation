export async function getHtmlTable(){
    try{
        const response = await axios.get(window.location.href)
        return await response.data
    }catch(error){
        throw error.response.data.errors
    }
}

export async function getItem(url){
    const response = await axios.get(url)
    return await response.data
}

export async function create(url, data){
    try{
        const response = await axios.post(url, data)
        return response.data
    }catch(error){
        throw error.response
    }
}

export async function update(url, data){
    try{
        const response = await axios.post(url, data)
        return response.data
    }catch(error){
        throw error.response
    }
}

export async function remove(url){
    try{
        const response = await axios.delete(url)
        return response.data
    }catch(error){
        throw error.response
    }
}