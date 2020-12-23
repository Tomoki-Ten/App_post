'use strict'
{
  const mask = document.getElementById('mask');
  const modal = document.getElementById('modal');

  // Modal Post
  const sidebarPost = document.getElementById('sidebar-post');
  const formclose = document.getElementById('form-close');
  const fileselector = document.getElementById('file-selector');
  const previewholder = document.getElementById('preview-holder');
  const previewclose = document.getElementById('preview-close');
  const preview = document.getElementById('preview');
  

  // Modal Window Post
  // Modal Window Post

  // ------ Toggle Post
  function toggler()
  {
    modal.classList.toggle('hidden');
    mask.classList.toggle('hidden');
  }
  
  // ----- Modal ON OFF Switch
  sidebarPost.addEventListener('click',toggler);
  formclose.addEventListener('click',toggler);
  mask.addEventListener('click',toggler);


  // Preview

  // ----- Reader
  function previewImage()
  {
    const file = document.getElementById('file-selector').files[0];
    const reader = new FileReader();

    reader.addEventListener('load',()=>{
      preview.src = reader.result;
    });
    if(file){
      reader.readAsDataURL(file);
    }
  }

  // ----- fn to make CloseIcon hidden
  function CloseIconHidden()
  {
    previewholder.classList.add('hidden');
    previewclose.classList.add('hidden');
  }

  // ----- fn Preview Switch ON OFF 
  function previewSwitch(){
    if(fileselector.files[0])
    {
      previewholder.classList.remove('hidden');
    }
    else
    {
      CloseIconHidden();
    }
  }

  // ----- Preview ON OFF
  fileselector.addEventListener('change',()=>
  {
    previewSwitch();
    previewImage();
  });

  // ----- CloseIcon to Make a PreviewHolder Empty
  previewclose.addEventListener('click',()=>
  {
    const file = document.getElementById('file-selector');
    file.value = '';
    preview.src = '';
    CloseIconHidden();
  });

}