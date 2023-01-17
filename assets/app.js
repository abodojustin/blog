import {Dropdown} from 'bootstrap';
import './styles/app.scss';
import bsCustomFileInput from 'bs-custom-file-input';

document.addEventListener('DOMContentLoaded', () => {
    new App();
});

class App {
    constructor() {
        this.enableDropdowns();
        this.handleCommentForm();
    }

    enableDropdowns = () => {
        const dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'))
        dropdownElementList.map(function (dropdownToggleEl){
            return new Dropdown(dropdownToggleEl)
        });
    }

    handleCommentForm(){
        const commentForm = document.querySelector('form.comment-form');

        if(null === commentForm){
            return;
        }

        commentForm.addEventListener('submit', async (e) =>{
            e.preventDefault();

            const response = await fetch('/ajax/comment', {
                method: 'POST',
                body: new FormData(e.target)
            });

            if(!response.ok){
                return;
            }

            const json = await response.json();

            console.log(json);
        })

    }
}