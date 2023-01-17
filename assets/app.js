import {Dropdown} from 'bootstrap';
import './styles/app.scss';
import bsCustomFileInput from 'bs-custom-file-input';

document.addEventListener('DOMContentLoaded', () => {
    enableDropdowns();
});

const enableDropdowns = () => {
    const dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'))
    dropdownElementList.map(function (dropdownToggleEl){
        return new Dropdown(dropdownToggleEl)
    });
}