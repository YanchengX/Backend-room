聊天室功能

實作網站 http://boesanyan.online/login
\電腦尺寸前端尚未調整完畢，使用小於 md 的尺寸或手機進行拜訪

可用功能:\
使用者登入，登出，刷新認證，使用者登入狀態\
查看資料統計\
使用者 CRUD\
房間 CURD\
加入房間，房間鑰匙認證，查詢房間，房間分頁查詢\
訂閱房間頻道傳送，獲得訊息

實作內容介紹:
JWT library 用 middleware 認證\
例外處理\
log 連接通知 TG\
http controller-repo 細分職責\
測試\
event/broadcast 訂閱房間獲得過往訊息
