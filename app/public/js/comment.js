'use strict'
{
  // Modal Comment
  const commentMask = document.getElementById('mask-comment');
  const modalComment = document.getElementById('modal-comment');


  const showCommentbtn = document.querySelector('.show-comment-btn');


  const commentFormclose = document.getElementById('comment-form-close');
  const commentFileselector = document.getElementById('comment-file-selector');
  const commentPreviewholder = document.getElementById('comment-preview-holder');
  const commentPreviewclose = document.getElementById('comment-preview-close');
  const commentPreview = document.getElementById('comment-preview');

  

  // Modal Window Edit
  // Modal Window Edit

  // ------ Toggle Edit Form
  function editToggle()
  {
    if(!commentPreview.src === '')
    {
      commentPreviewholder.classList.add('hidden');
    }
    modalComment.classList.toggle('hidden');
    commentMask.classList.toggle('hidden');
  }


  // ----- Modal ON OFF Switch
  showCommentbtn.addEventListener('click',()=>
  {
    editToggle();
  });



  commentFormclose.addEventListener('click',editToggle);
  commentMask.addEventListener('click',editToggle);


  // Preview
  // ----- File Reader
  function editPreviewImage()
  {
    const file = document.getElementById('comment-file-selector').files[0];
    const reader = new FileReader();

    reader.addEventListener('load',()=>{
      commentPreview.src = reader.result;
    });
    if(file){
      reader.readAsDataURL(file);
    }
  }

  // ----- fn to make CloseIcon hidden
  function editCloseIconHidden()
  {
    commentPreviewholder.classList.add('hidden');
    commentPreviewclose.classList.add('hidden');
  }

  // ----- fn Preview Switch ON OFF 
  function editPreviewSwitch(){
    if(commentFileselector.files[0])
    {
      commentPreviewholder.classList.remove('hidden');
    }
    else
    {
      editCloseIconHidden();
    }
  }

  // ----- Preview ON OFF
  commentFileselector.addEventListener('change',()=>
  {
    editPreviewSwitch();
    editPreviewImage();
  });

  // ----- CloseIcon to Make a PreviewHolder Empty
  commentPreviewclose.addEventListener('click',()=>
  {
    const file = document.getElementById('comment-file-selector');
    file.value = '';
    preview.src = '';
    editCloseIconHidden();
  });
  
}