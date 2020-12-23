'use strict'
{
  /* ----- Delete Comment ----- */
  /* ----- Delete Comment ----- */

  // Definitions
  const deleteCommentbtn = document.querySelector('.comment-delete-btn');
  const deleteForm = document.querySelector('.comment-delete-btn-form');
  
  // Confirm
  deleteCommentbtn.addEventListener('click',()=>
  {
    if(window.confirm('この投稿を削除してもよろしいですか？'))
    {
      deleteForm.submit();
    }
  });
   
}