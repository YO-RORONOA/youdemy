async function loadData(controller, id) {
    try {
        const response = await fetch(`../../controllers/${controller}.php?id=${id}`);
        console.log(response)

        const responseData = await response.json();
        console.log(responseData)
        
        if(controller == 'categorieController')
        {
            document.getElementById('category_modal').value = responseData.name; 
            document.getElementById('category_id').value = responseData.id; 
        }
        else
        {
        document.getElementById('tag_modal').value = responseData.name; 
        document.getElementById('tag_id').value = responseData.id;      
        }
        if (!response.ok) {
            throw new Error('Error loading category data.');
        }
  

    } catch (error) {
        alert(error.message);
    }
}