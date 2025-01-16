

async function loadData(course) {
    let courseId = course

    try {
        const response = await fetch(`../../controllers/teachercontroller/CourseController.php?action=edit&id=${courseId}`)
        console.log(response)

        const responseData = await response.json();
        console.log(responseData)
        const tagids = responseData.tag_ids.split(',');
        console.log(tagids)

        document.getElementById('courseId').value = responseData.id;
        document.getElementById('courseTitle').value = responseData.title;
        document.getElementById('courseDescription').value = responseData.description;
        // document.getElementById('contentType').value = responseData.contentType;
        document.getElementById('contentUrl').value = responseData.content;
        // document.getElementById('category').value = responseData.name;
        document.getElementById('wallpaperUrl').value = responseData.wallpaper_url;
        document.getElementById('videoHours').value = responseData.video_hours;
        document.getElementById('articles').value = responseData.nb_articles;
        document.getElementById('resources').value = responseData.nb_resources;


        console.log(responseData.content_type)
        const selectContenttype = document.getElementById('contentType');
        for (let option of selectContenttype.options) {
            if (option.value === responseData.content_type) {
                option.selected = true;
            } 
        }

        const selectcategory = document.getElementById('category');
        for (let option of selectcategory.options) {
            if (option.text === responseData.name) {
                option.selected = true;
            } 
        }




        document.querySelectorAll('input[name="tags[]"]').forEach(tagCheckbox => {
            tagCheckbox.checked = tagids.includes(tagCheckbox.value);
        });
        
        // document.getElementById('tag_modal').value = responseData.name; 
        // document.getElementById('tag_id').value = responseData.id;      
        
        if (!response.ok) {
            throw new Error('Error loading category data.');
        }
  

    } catch (error) {
        alert(error.message);
    }
}