//function to display the folder location on the quick access

function get_location(){
    let iframe_g = document.getElementById('parent-content-container');

    let quick_access = document.forms['select-directory']['quick_access_path'];

    document.getElementById('hidden-iframe').src = iframe_g.contentWindow.location.href;

    quick_access.value = iframe_g.contentWindow.location.href;
}

//function to change directory using the middle bar of the base.html file
function path_breakdown(path){
    let length = path.length;
    let number_of_folders = 0;
    let counter = 0;
    //finding the number of directories along the path
    while(counter < length){
        if(path.charAt(counter) === '/')
        {
            number_of_folders += 1;
        }
        counter += 1;
    }

    //refining our path ro remove duplicate slashes
    counter = 0;
    while(counter < path.length){
        if((path.charAt(counter) === '/') && (path.charAt(counter + 1) === '/'))
        {
            path = path.replace("//", "/");
        }
        counter += 1;
    }
    number_of_folders -= 1;
    //creating an array of directories
    let folder_array = [];
    for(let i = 0; i < number_of_folders; i ++)
    {
        let counter = 0;
        while(!(path.charAt(counter) === '/')){
            counter += 1;
        }
        folder_array.push(path.slice(0, counter));
        counter += 1;
        path = path.slice(counter, length);
    }
    return folder_array;
}
let folder_index = 0;
window.previous_paths = [];
function up_directory(){
    let path = document.forms['select-directory']['quick_access_path'].value;
    let folder_array = path_breakdown(path);
    let path_length = path.length;
    let posterior = 0;
    //get text between slashes
     folder_index = (folder_array.length - 1);
    previous_paths.push(path);
     if(!(path.charAt(path_length - 1) === '/')){
         posterior = (folder_array[folder_index].length + folder_array[folder_index - 1].length + 1);
         path = path.slice(0, (path_length - posterior));
     }else{
         posterior = (folder_array[folder_index].length + 1);
         path = path.slice(0, (path_length - posterior));
     }
     previous_paths.push(path);
     let up_button = document.getElementById('parent-up-directory');
     up_button.href = path;
}

function down_directory(){
    let path_counter = window.previous_paths.length;
    let path = document.forms['select-directory']['quick_access_path'].value;

    let counter = 0;

    while(counter < path_counter - 1)
    {
        if(window.previous_paths[counter] === path)
        {
            break;
        }

        counter += 1;
    }
    path = window.previous_paths[counter - 1];

    let down_button = document.getElementById('child-down-directory');
    down_button.href = path;
}
//function to display child folders
function display_children(){
    let list_container = document.getElementsByClassName('inner-folders-list');
    let path = document.forms['select-directory']['quick_access_path'].value;
    let folder_array = path_breakdown(path);
    let counter = 0;
    while(counter < folder_array.length){
        let tag = document.createElement("li");
        let folder = document.createTextNode(folder_array[counter]);
        tag.appendChild(folder);
        list_container.appendChild(tag);
        counter += 1;
    }
}

//function to display parent_folder_selector
function display_parent_folder_selector(){
    let parent_selector = document.getElementsByClassName('new_folder_frame_div');
    parent_selector[0].style.display = "block";
    let form = document.forms['new_folder_form'];
    form.style.display = "none";
}

function get_parent_folder(){
    let iframe = document.getElementById('get_parent');
    let input_parent_folder = document.forms['new_folder_form']['parent_folder'];

    input_parent_folder.value = iframe.contentWindow.location.href;

    let parent_selector = document.getElementsByClassName('new_folder_frame_div');
    parent_selector[0].style.display = "none";

    let form = document.forms['new_folder_form'];
    form.style.display = "block";
}

function delete_div(){
    let parent_selector = document.getElementsByClassName('new_folder_frame_div');
    parent_selector[0].style.display = "none";

    let form = document.forms['new_folder_form'];
    form.style.display = "block";
}

function remove_form(){
    let form = document.forms['new_folder_form'];
    form.style.display = "none";
}

//function to display my other operations div
function display_other_operations_div(){
    let op_div = document.getElementsByClassName('other-operations-div');
    op_div[0].style.display = "block";
}

//beginning of functions to toggle the switch in settings
class Toggle_Switch{
    static state = 0;
    toggle_switch()
    {
        Toggle_Switch.state += 1;
    }
}
function toggle_switch(){
    let state = new Toggle_Switch();
    state.toggle_switch();
}
function set_of()
{
    let button = document.getElementById('button');
    let background = document.getElementById('switch');
    button.style.color = "dimgray";
    button.style.cssFloat = "left";
    button.style.marginLeft = "-15%";
    background.style.backgroundColor= "darkgrey";

}
function set_on(){
    let button = document.getElementById('button');
    let background = document.getElementById('switch');

    button.style.color = "rebeccapurple";
    button.style.cssFloat = "right";
    button.style.marginRight = "-15%";
    background.style.backgroundColor = "mediumpurple";


}
function set_switch(){
    if((Toggle_Switch.state === 0) || ((Toggle_Switch.state % 2) === 0)){
        setInterval(set_of, 10);
    }else if(!(Toggle_Switch.state === 0) && !((Toggle_Switch.state % 2) === 0)){
        setInterval(set_on, 10);
    }
}

//function to get the directory path of the folder attached to favorites
function get_path_attached_favorites(){
    let hidden_iframe = document.getElementById('hidden-iframe');
    let folder_array = path_breakdown(hidden_iframe.src);
    let num_folders = folder_array.length;
    folder_array[0] = "/opt/lampp/htdocs";

    let new_folder_array = [];
    let counter = 0
    while(counter < num_folders){
        new_folder_array[counter] = folder_array[counter];
        new_folder_array[counter + 1] = "/";
        counter += 1;
    }

    let final_path = new_folder_array.join('');

    let form = document.forms['attach_favorite']['folder_path'];
    form.value = final_path;
    alert(form.value);
}