import * as vanillaTextMask from 'vanilla-text-mask/dist/vanillaTextMask.js';
import emailMask from 'text-mask-addons/dist/emailMask';

const phoneMask = () => {
    const phone = ['+', '3', '8', ' ', '(', /[0-9]/, /\d/, /\d/, ')', ' ', /\d/, /\d/, '-', /\d/, /\d/, '-', /\d/, /\d/, /\d/];
    const text = s => Array.from(s).map(() => /[a-zа-я]/i);

    const phoneInputAll = document.querySelectorAll('.phone-mask');
    const emailInputAll = document.querySelectorAll('.email-mask');
    const textInputAll = document.querySelectorAll('.text-mask');

    phoneInputAll?.forEach(item => {
        vanillaTextMask.maskInput({
            inputElement: item,
            mask: phone,
        });
    });

    emailInputAll?.forEach(item => {
        vanillaTextMask.maskInput({
            inputElement: item,
            mask: emailMask,
        });
    });

    textInputAll?.forEach(item => {
        vanillaTextMask.maskInput({
            inputElement: item,
            mask: text,
            guide: false,
        });
    });
}

export default phoneMask;