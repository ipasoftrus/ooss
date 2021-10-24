<?php
/**     ipaSoft Electronics (c) 2021        **
 **     Online Order Status Script          **
 **     Default language module             **
 **                                         */
final class Language {
    // Error explanations
    const errorDbConnect = "На сайте возникли неполадки. Ошибка подключения к базе данных";
    const errorConfigNotExists = "Воспользуйтесь программой установки, прежде чем начать. ";
    const errorUserNotFound = "Пользователь не найден";
    const errorPasswordWrong = "Неверный пароль";
    // Array descriptions
    const roleDescriptions = array("Заблокированный", "Заказчик", "Менеджер", "Мастер", "Администратор");
    // Page titles
    const titleMain = "Главная";
    const titleAdmin = "Настройки сайта";
    // Signs
    const signLogin = "Логин";
    const signPassword = "Пароль";
    const signSignOut = "Выход из системы";
    const signGoodNight = "Доброй ночи";
    const signGoodMorning = "Доброе утро";
    const signGoodDay = "Добрый день";
    const signGoodEvening = "Добрый вечер";
    const signRole = "Ваши полномочия";
    // Меню
    const menuProfile = "Личный кабинет";
    const menuChats = "Сообщения";
    const menuChatsAll = "Открыть переписки";
    const menuMyStatuses = "Мои заказы";
    const menuToMyManager = "Написать менеджеру";
    const menuToMyMaster = "Написать мастеру";
    const menuToMyDirector = "Написать директору";
    const menuManageOrders = "Управление заявками";
    const menuManageOrdersAll = "Открыть заявки";
    const menuSettings = "Настройки";
    const menuSettingsGeneral = "Общие";
    const menuSettingsUser = "Пользователи";
}
