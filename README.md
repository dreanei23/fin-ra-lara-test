# Простой REST API для счетчиков маркетинговой статистики.

## Для доступа к API нужно передавать в Header заголовке APIKEY: FIN-RA




>POST /stat (Добавить статистику)

**params:**
* date (format: YYYY-MM-DD) [required]
* views
* clicks
* cost
* clear=1 **Внимание! Этот параметр полностью очистит статистику**

>GET /stat (Получить статистику за период времени)

**params:**
* from_date (format: YYYY-MM-DD) [required]
* to_date (format: YYYY-MM-DD) [required]
* sortBy (format: field|order_type)
* groupBy

### Пример:
```
/stat?form_date=2021-07-13&to_date=2021-07-15&sortBy=clicks|desc&groupBy=date
```
