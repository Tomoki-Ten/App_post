'use strict'
{
  // Modal Edit
  const editMask = document.getElementById('edit-mask');
  const modalPostedit = document.getElementById('modal-post-edit');

  const showEditbtn = document.querySelector('.show-edit-btn');

  const editFormclose = document.getElementById('edit-form-close');
  const editFileselector = document.getElementById('edit-file-selector');
  const editPreviewholder = document.getElementById('edit-preview-holder');
  const editPreviewclose = document.getElementById('edit-preview-close');
  const editPreview = document.getElementById('edit-preview');

  const editSign = document.getElementById('edit-sign');
  const closeLabel = document.querySelector('.edit-close-label');

  

  /* Modal Window Edit */

  // ------ ON OFF functions
  function editOn()
  {
    modalPostedit.classList.remove('hidden');
    editMask.classList.remove('hidden');
  }

  function editOff()
  {
    modalPostedit.classList.add('hidden');
    editMask.classList.add('hidden');
  }

  // ----- Modal Edit ON 
  showEditbtn.addEventListener('click',editOn);

  // ----- Modal Edit OFF
  editFormclose.addEventListener('click',editOff);
  editMask.addEventListener('click',editOff);


  /* Preview */
  // ----- File Reader
  function editPreviewImage()
  {
    const file = document.getElementById('edit-file-selector').files[0];
    const reader = new FileReader();

    reader.addEventListener('load',()=>{
      editPreview.src = reader.result;
    });
    if(file){
      reader.readAsDataURL(file);
    }
  }

  // ----- プレビューを表示 function 
  function editPreviewSwitch(){
    editPreviewholder.classList.remove('hidden');
    closeLabel.classList.remove('hidden');
    editSign.checked = false;
  }

  // ----- イメージファイル 読み込み時
  editFileselector.addEventListener('change',()=>
  {
    editPreviewImage();
    editPreviewSwitch();
  });


  // ----- CloseIcon プレビュー隠す function
  function previewClose()
  {
    editPreviewholder.classList.add('hidden');
    editPreviewclose.classList.add('hidden');
  }

  // ----- CloseIcon to Make a PreviewHolder Empty
  editPreviewclose.addEventListener('click',()=>
  {
    editFileselector.value = '';
    editPreview.src = '';
    previewClose();
  });
  

  /* ----- Delete Post ----- */
  // Definitions
  const deletePostbtn = document.querySelector('.show-delete-btn');
  const deleteForm = document.querySelector('.show-delete-form');
  
  // Confirm
  deletePostbtn.addEventListener('click',()=>
  {
    if(window.confirm('この投稿を削除してもよろしいですか？'))
    {
      deleteForm.submit();
    }
  });
  
}