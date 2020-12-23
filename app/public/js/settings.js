'use strict'
{
  const defaultImage = document.getElementById('preview-default');

  const profilePreview = document.querySelector('.profile-preview');
  const fileInput = document.getElementById('profileimage');

  const profileClose = document.querySelector('.profile-close');

  const closeLabel = document.getElementById('close-label');
  const closeCkbox = document.getElementById('close-ckbox');
  
  
   // ----- Reader
  function previewProfile()
  {
    const file = document.getElementById('profileimage').files[0];
    const reader = new FileReader();

    reader.addEventListener('load',()=>{
      profilePreview.src = reader.result;
    });
    if(file){
      reader.readAsDataURL(file);
    }
  }

  // ----- Read
  fileInput.addEventListener('change',()=>
  {
    defaultImage.classList.add('hidden');
    profilePreview.classList.remove('hidden');
    previewProfile();
    /* クローズアイコン、表示する - チェックボックスを、OFFにする*/
    if(fileInput.value)
    {
      closeLabel.classList.remove('hidden');
      
      if(closeCkbox)
      {
        closeCkbox.checked = false;
      }
    }
  });

  // ----- File Remove
  profileClose.addEventListener('click',()=>{
    const file = document.getElementById('profileimage');
    file.value = '';
    profilePreview.src = '';
    defaultImage.classList.remove('hidden');
    profilePreview.classList.add('hidden');
    /* クローズアイコン、消す */
    closeLabel.classList.add('hidden');
  });

}