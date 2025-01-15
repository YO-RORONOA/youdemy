

async function loadData(id) {
    let id = id  

    try {
        const response = await fetch(`../../controllers/teachercontroller/CourseController.php?action=edit&id=${id}`)
        console.log(response)

        const responseData = await response.json();
        console.log(responseData)
        
        
        // document.getElementById('tag_modal').value = responseData.name; 
        // document.getElementById('tag_id').value = responseData.id;      
        
        if (!response.ok) {
            throw new Error('Error loading category data.');
        }
  

    } catch (error) {
        alert(error.message);
    }
}