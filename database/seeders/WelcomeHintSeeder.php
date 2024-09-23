<?php

namespace Database\Seeders;

use App\Models\WelcomeHint;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class WelcomeHintSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $welcomeHints = [
            '<div class="modal modal--tip" id="modal-tip-1">
                <div class="modal__inner">
                  <div class="modal__window">
                    <div class="modal__text">
                      <h3>Шановний користувач!</h3>
                      <p>Раді вітати Вас у онлайн сервісі Lex go.</p>
                      <p>Будь-ласка, ознайомтесь з базовими етапами роботи з сервісом, щоб час на пошук зменшився, а релевантність відповідала Вашим очікуванням.</p>
                      <p>Для пошуку необхідної інформації спробуйте: </p>
                      <p>- «Пошук по базі» (пошук за словами у правових позиціях) </p>
                      <p>- «Пошук по категоріях» (пошук за словами в назвах категорій)</p>
                      <p>- «Ручний перехід по категоріях» - найбільш точний</p>
                    </div>
                    <button class="button modal__ok-button" type="button" data-modal-once="modal-tip-2">Добре</button>
                  </div>
                </div>
              </div>',
            '<div class="modal modal--tip" id="modal-tip-2">
                <div class="modal__inner">
                  <div class="modal__window">
                    <div class="modal__text">
                      <h3>На початку Вашого пошуку <span class="red-color">не використовуйте</span> "Пошук по збірнику" (пошук за словами у правових позиціях)</h3>
                      <p>У випадку використання такого пошуку, релевантність відповіді стандартна, як і в інших системах. </p>
                      <p>Ви залежні, як і в інших системах, від коректності пошукового запиту та нерозуміння системою семантичного значення слова, речення, абзацу! Існує ризик того, що необхідну Вам інформацію, яка є у системі,  Ви не побачите саме через некоректний запит. </p>
                      <p>Пошук має починатися із дослідження змісту кодексу, щоб відшукати необхідну категорію, у якій збережені правові позиції Верховного Суду за тематикою. Для цього Вам потрібно натиснути: <img src="'.asset('assets/img/user/modul-kk.webp').'" width="58" height="25" loading="lazy" alt="alt"/> і <img src="'.asset('assets/img/user/modul-kk.webp').'" width="67" height="25" loading="lazy" alt="alt"/></p>
                    </div>
                    <button class="button modal__ok-button" type="button" data-modal-close="data-modal-close">Добре</button>
                  </div>
                </div>
              </div>',
            '<div class="modal modal--tip" id="modal-tip-3">
                <div class="modal__inner">
                  <div class="modal__window">
                    <div class="modal__text">
                      <h3>Інформація!</h3>
                      <p>Ліва частина екрану відображає зміст кодексу представлений у виді категорій, побудованих за ієрархією (для КПК Розділ/Глава/Стаття/Категорія/Підкатегорія….; для КК Розділ/Стаття/Категорія/Підкатегорія). На даний час у системі більше 2200 категорій, наповнених правовими позиціями. </p>
                      <p>Тут Ви бачите пікторгаму чекбоксу <img src="'.asset('assets/img/user/checkbox.webp').'" width="28" height="28" loading="lazy" alt="alt"/> (фіксує одну чи декілька категорій для використання їх в пошуку) та піктограму <img src="'.asset('assets/img/user/arrow-button.webp').'" width="28" height="28" loading="lazy" alt="alt"/>, яка розкриває категорію до більш дрібних за темою категорій.</p>
                    </div>
                    <button class="button modal__ok-button" type="button" data-modal-close="data-modal-close">Добре</button>
                  </div>
                </div>
              </div>',
            '<div class="modal modal--tip" id="modal-tip-4">
                <div class="modal__inner">
                  <div class="modal__window">
                    <div class="modal__text">
                      <h3>Інформація!</h3>
                      <p>Оберіть необхідну категорію з назвою, дотичною до суті Вашого питання. Розкривайте зміст категорій до кінцевої категорії, звужуючи коло для пошуку до максимуму, збільшуючи успішність пошуку. </p>
                      <p>Піктограма <img src="'.asset('assets/img/user/arrow-button.webp').'" width="28" height="28" loading="lazy" alt="alt"/> сигналізує, що у даній категорії є вкладеності (інші категорії). У разі, якщо Ви не знаєте у якій статті кодексу може знаходитись необхідна Вам категорія, скористайтеся «Пошуком по категоріях»</p>
                    </div>
                    <button class="button modal__ok-button" type="button" data-modal-close="data-modal-close">Добре</button>
                  </div>
                </div>
              </div>',
            '<div class="modal modal--tip" id="modal-tip-5">
                <div class="modal__inner">
                  <div class="modal__window">
                    <div class="modal__text">
                      <h3>Інформація!</h3>
                      <p>Натисніть на чекбокс та на кнопку «показати». Система підбере правові позицій у зафіксованій категорії. Ви також одночасно можете зафіксувати декілька категорій. </p>
                      <p>У разі, якщо Ви не знаєте у якій категорії (Розділ, Глава, стаття, категорія, тощо) може знаходитись необхідна Вам категорія, скористайтеся «Пошуком по категоріях»</p>
                    </div>
                    <button class="button modal__ok-button" type="button" data-modal-close="data-modal-close">Добре</button>
                  </div>
                </div>
              </div>',
            '<div class="modal modal--tip" id="modal-tip-6">
                <div class="modal__inner">
                  <div class="modal__window">
                    <div class="modal__text">
                      <h3>Інформація!</h3>
                      <p>Якщо Ви не розумієте, до суті якої статті/категорії може відноситись Ваше питання, введіть пошукове слово у вікно «Пошук по категоріях». </p>
                      <p>Система буде шукати пошукове слово Вашого запиту у назвах категорій. Категорії, у назвах яких містяться слова Вашого пошукового запиту, будуть відображатися нижче. Зафіксуйте необхідну категорію чекбоксом та натисніть «Пошук».</p>
                      <p><strong class="red-color">Увага!</strong> Використовуйте одне головне слово, на кшталт (обшук, строк, слідчий, акт, документ, показання, висновок, експерт, ухвала, авто, житло, акт, обвинувальний, витяг, ЄРДР, слідчий, потерпілий, тощо), а далі досліджуйте категорії. </p>
                      <p>Для найбільш успішного пошуку, бажано шукати категорію вручну. Таким чином Ви маєте змогу дослідити більше назв категорій та семантично вирішити, чи підходить та чи інша категорія до суті Вашого питання. </p>
                      <p>Якщо суть Вашого питання відноситься до оцінки доказу, обов’язково вручну пройдіться по статтях Глави 4, в першу чергу зверніть увагу на ст. 95-97, 99, 100, 101-102 КПК , а далі по спеціалізованих статтях конкретного питання.</p>
                    </div>
                    <button class="button modal__ok-button" type="button" data-modal-close="data-modal-close">Добре</button>
                  </div>
                </div>
              </div>',
            '<div class="modal modal--tip" id="modal-tip-7">
                <div class="modal__inner">
                  <div class="modal__window">
                    <div class="modal__text">
                      <h3>Інформація!</h3>
                      <p>Головне меню LEX go. Тут будуть з’являтися нові модулі</p>
                      <p>Модулі КК та КПК надають можливість пошуку правових позицій щодо правозастосування кримінального та кримінального процесуального законодавства з постатейною логікою збереження правових позицій</p>
                      <p>«Кабінет» - віртуальне середовище для збереження закладок, створення кейсів для збереження закладок, тощо.</p>
                      <p>«Реєстри» - збірник найпоширеніших реєстрів для використання правником</p>
                      <p>«Моя підписка» - модуль контроля стану підписки</p>
                    </div>
                    <button class="button modal__ok-button" type="button" data-modal-close="data-modal-close">Добре</button>
                  </div>
                </div>
              </div>',
            '<div class="modal modal--tip" id="modal-tip-8">
                <div class="modal__inner">
                  <div class="modal__window">
                    <div class="modal__text">
                      <h3>Інформація!</h3>
                      <p>Маєте можливість зберегти в кабінет закладку на правову позицію. За замовчуванням у кабінет збережеться вся необхідна інформація по правовій позиції (висновку суду): правова позиція (висновок суду), коротка назва, посилання на судове рішення, судове рішення, дата, вид касації. </p>
                    </div>
                    <button class="button modal__ok-button" type="button" data-modal-close="data-modal-close">Добре</button>
                  </div>
                </div>
              </div>',
            '<div class="modal modal--tip" id="modal-tip-9">
                <div class="modal__inner">
                  <div class="modal__window">
                    <div class="modal__text">
                      <h3>Інформація!</h3>
                      <p>Збереження інформації через редактор. Інформація також зберігається в кабінеті. Використовуючи функціонал редактора, маєте можливість редагувати текст, виділяти маркером головне, тощо.</p>
                    </div>
                    <button class="button modal__ok-button" type="button" data-modal-close="data-modal-close">Добре</button>
                  </div>
                </div>
              </div>',
            '<div class="modal modal--tip" id="modal-tip-10">
                <div class="modal__inner">
                  <div class="modal__window">
                    <div class="modal__text">
                      <h3>Інформація!</h3>
                      <p>Копіювання посилання на судове рішення в Єдиному реєстрі судових рішень до буферу обміну.</p>
                    </div>
                    <button class="button modal__ok-button" type="button" data-modal-close="data-modal-close">Добре</button>
                  </div>
                </div>
              </div>',
            '<div class="modal modal--tip" id="modal-tip-11">
                <div class="modal__inner">
                  <div class="modal__window">
                    <div class="modal__text">
                      <h3>Інформація!</h3>
                      <p>Завантаження файлу до внутрішнього носія інформації. За замовчуванням завантажується файл формату docx або pdf виходячи з налаштування Вашого обладнання. Файл буде містити: правову позицію (висновок суду), коротку назву, посилання на судове рішення, судове рішення, дата, вид касації.</p>
                    </div>
                    <button class="button modal__ok-button" type="button" data-modal-close="data-modal-close">Добре</button>
                  </div>
                </div>
              </div>',
            '<div class="modal modal--tip" id="modal-tip-12">
                <div class="modal__inner">
                  <div class="modal__window">
                    <div class="modal__text">
                      <h3>Інформація!</h3>
                      <p>Використовуючи кнопку <img src="'.asset('assets/img/user/arrow-button-left.webp').'" width="28" height="28" loading="lazy" alt="alt"/>, Ви можете прибрати зміст кодексу, вивільнивши додаткове місце для аналізу тексту правових позицій. Актуально для малих екранів та збільшує швидкість аналізу тексту. </p>
                      <p>1. Більше правових позицій виводиться на екран. </p>
                      <p>2. Кількість символів у стовпчику «ПП» (правові позиції) збільшується на 25%.</p>
                    </div>
                    <button class="button modal__ok-button" type="button" data-modal-close="data-modal-close">Добре</button>
                  </div>
                </div>
              </div>',
            '<div class="modal modal--tip" id="modal-tip-13">
                <div class="modal__inner">
                  <div class="modal__window">
                    <div class="modal__text">
                      <h3>Інформація!</h3>
                      <p>Кожен раз, коли параметри Вашого пошуку змінюються, використовуйте кнопку «Скинути». Функціональність даної кнопки скидає всі зафіксовані чекбокси та пошукові запити у полях «Пошук по категоріях» та «Пошук по базі», а зміст кодексу згортається до початкового значення.</p>
                    </div>
                    <button class="button modal__ok-button" type="button" data-modal-close="data-modal-close">Добре</button>
                  </div>
                </div>
              </div>',
            '<div class="modal modal--tip" id="modal-tip-14">
                <div class="modal__inner">
                  <div class="modal__window">
                    <div class="modal__text">
                      <h3>Звертаємо увагу ще раз на черговість Ваших дій з пошуку інформації. </h3>
                      <p>1. В першу чергу шукайте необхідну категорію (папка, тема), так уникнете ризиків неправильного семантичного розуміння пошукового запиту</p>
                      <p>2. Пошук категорії відбувається у змісті кодексу або вручну, або з використанням пошуку по категорії</p>
                      <p>3. В останню чергу пройдіться пошуком «по базі».</p>
                      <p>4. Для швидкого орієнтування у змісті КПК ознайомтесь вручну з усіма категоріями у Главі 4 КПК, оскільки майже кожне питання стосується цієї Глави (у більшості випадків)</p>
                      <p>Наша пошукова система передбачає врахування зміни закінчень та зв’язку слів, візуалізує пошукові слова у тексті. Але цього замало! Дуже замало, коли йдеться про релевантність та швидкість. Саме тому Ви читаєте багато непотрібної – нерелевантної інформації у подібних пошукових системах.</p>
                      <p>Майте на увазі, що на сьогодні жодна система не забезпечує належне семантичне розуміння тексту. Обираючи необхідну категорію Ви отримуєте відповіді з усіх можливих ситуацій на одне питання, при цьому зі змінами у часі. Таким чином Ви економите свій час та отримуєте більше релевантної інформації за помірну ціну.</p>
                    </div>
                    <button class="button modal__ok-button" type="button" data-modal-close="data-modal-close">Добре</button>
                  </div>
                </div>
              </div>'
        ];

        Schema::disableForeignKeyConstraints();
        WelcomeHint::truncate();
        Schema::enableForeignKeyConstraints();
        foreach ($welcomeHints as $html)
            WelcomeHint::create(['html' => $html]);
    }
}
