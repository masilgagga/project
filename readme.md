<br>

# 🚶‍♂️🚶‍♀️ 대구 산책길 검색사이트 '마실가까'
![image](https://github.com/user-attachments/assets/8264d257-0337-4633-9f34-53fb1aa1dfd2)

* [배포 URL](http://zinee.dothome.co.kr/)
* [PPT](https://docs.google.com/presentation/d/10hKS6EJjQPwZhumJOzukBhtuIsNGbDED/edit?usp=drive_link&ouid=105443513577226796679&rtpof=true&sd=true)
  
<br>
<br>

## 📚 프로젝트 소개

<div align="center"><img src="https://github.com/user-attachments/assets/7b0e80d1-bf14-4eba-8d33-d2bc2092df4b"></div>

<br>

* **마실가까**는 대구지역의 다양한 산책길을 손쉽게 검색하고 정보를 확인할 수 있는 웹사이트입니다.
* 간편하게 소셜로그인으로 로그인할 수 있습니다.
* 소셜로그인후 자신만의 산책길을 저장하고 이벤트에 참여할 수 있습니다.
* 관리자페이지로 회원을 관리할 수 있고 이벤트를 등록하고 삭제할 수 있습니다.

<br>
<br>


## 👨‍🏫 팀원 구성

<table>
  <tbody>
    <tr>
      <td align="center"><b>김환</b> 팀장</td>
       <td align="center"><b>권혜진</b> 팀원</td>
       <td align="center"><b>박정선</b> 팀원</td>
    </tr>
    <tr>
      <td align="center"><a href="https://github.com/ghks6455"><img src="https://avatars.githubusercontent.com/u/175993241?v=4" width="200px" alt=""/><br />@ghks6455</a></td>
      <td align="center"><a href="https://github.com/zinee81"><img src="https://avatars.githubusercontent.com/u/174780546?v=4" width="200px" alt=""/><br />@zinee81</a></td>
      <td align="center"><a href="https://github.com/jeongsun-park"><img src="https://avatars.githubusercontent.com/u/175993255?v=4" width="200px" alt=""/><br />@jeongsun-park</a></td>
     <tr/>
       <tr>
         <td align="center">프론트 엔드<br/>웹 퍼블리싱</td>
         <td align="center">백 엔드<br/>웹 퍼블리싱</td>
         <td align="center">UI/UX 설계 및 디자인<br/>웹 퍼블리싱</td>
       </tr>
  </tbody>
</table>

<br>
<br>

## 🗓 개발 기간 및 작업 환경
### 개발 기간

* 전체 개발 기간 : 2024.10.04 ~ 2024.10.31
* UI/UX 설계 및 디자인 : 2024.10.07 ~ 2024.10.22
* 웹 구현,개발 : 2024.10.11 ~ 2024.10.25
* 백엔드 개발 : 2024.10.11 ~ 2024.10.25
  
### 작업 환경
* 아침 회의를 진행하며 작업 순서와 방향성에 대한 고민을 나누고 inssues에 회의 내용을 기록했습니다.
* 그 외 소통이나 데이터공유는 slack을 이용했습니다.

<br>
<br>

## 📝 기술 스택

<br>

<div>
  <img src="https://img.shields.io/badge/html5-E34F26?style=for-the-badge&logo=html5&logoColor=white"> 
  <img src="https://img.shields.io/badge/css-1572B6?style=for-the-badge&logo=css3&logoColor=white"> 
  <img src="https://img.shields.io/badge/javascript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black">
  <img src="https://img.shields.io/badge/php-4F71C9?style=for-the-badge&logo=php&logoColor=black">
  <img src="https://img.shields.io/badge/MySQl-5580EF?style=for-the-badge&logo=MySQl&logoColor=white">
  <img src="https://img.shields.io/badge/jQuery-2455D0?style=for-the-badge&logo=jQuery&logoColor=white">
</div>
<div>
  <img src="https://img.shields.io/badge/Figma-9847FF?style=for-the-badge&logo=figma&logoColor=white">
  <img src="https://img.shields.io/badge/Photoshop-475AFF?style=for-the-badge&logo=adobephotoshop&logoColor=white">
  <img src="https://img.shields.io/badge/Illustrator-FFC147?style=for-the-badge&logo=adobeillustrator&logoColor=white">
</div>
<div>
  <img src="https://img.shields.io/badge/github-181717?style=for-the-badge&logo=github&logoColor=white">
  <img src="https://img.shields.io/badge/git-F05032?style=for-the-badge&logo=git&logoColor=white">
</div>


<br>
<br>

## 🖥 프로젝트 구조
```
📦project
 ┣ 📂config
 ┃ ┗ 📜const.php
 ┣ 📂css
 ┃ ┣ 📜footer.css
 ┃ ┣ 📜header.css
 ┃ ┣ 📜index.css
 ┃ ┣ 📜index_side_bar.css
 ┃ ┣ 📜walk_admin.css
 ┃ ┣ 📜walk_admin_event.css
 ┃ ┣ 📜walk_correctly.css
 ┃ ┣ 📜walk_event.css
 ┃ ┣ 📜walk_event_detail.css
 ┃ ┣ 📜walk_finder.css
 ┃ ┣ 📜walk_info.css
 ┃ ┣ 📜walk_login.css
 ┃ ┗ 📜walk_my.css
 ┣ 📂image
 ┣ 📂like_list
 ┃ ┣ 📜my_walk.php
 ┃ ┣ 📜my_walk_delete.php
 ┃ ┗ 📜my_walk_insert.php
 ┣ 📂login
 ┃ ┣ 📜login_kakao.php
 ┃ ┗ 📜login_naver.php
 ┣ 📜footer.php
 ┣ 📜header.php
 ┣ 📜index.php
 ┣ 📜readme.md
 ┣ 📜walk_admin.php
 ┣ 📜walk_admin_event.php
 ┣ 📜walk_admin_user_delete.php
 ┣ 📜walk_a_comment_delete.php
 ┣ 📜walk_a_event_delete.php
 ┣ 📜walk_a_event_insert.php
 ┣ 📜walk_comment_delete.php
 ┣ 📜walk_comment_insert.php
 ┣ 📜walk_correctly.php
 ┣ 📜walk_event.php
 ┣ 📜walk_event_detail.php
 ┣ 📜walk_finder.php
 ┣ 📜walk_info.php
 ┣ 📜walk_login.php
 ┣ 📜walk_my.php
 ┣ 📜walk_my_delete.php
 ┗ 📜walk_my_insert.php
```
<br>
<br>

## ✨ 구현 기능
### 검색 필터링
ㅇㅇㅇ
### 소설 로그인
ㄹㄹㄹ
### 내산책길 추가하기
ㄹㄹㄹ
### 관리자 페이지
ㅎㅎㅎ


<br>
<br>

## 🏃‍♂️ 개선 목표


<br>
<br>

## 🗨 자체 평가 및 소감

<br>

### 🤦‍♂️ 권혜진

  **자체평가**<br>
 &emsp;처음 시작할 때는 산책길에 대해 소개하고 소셜 로그인으로 회원가입을 받고 내 산책길에 추가하고 삭제하는 것만 구현하기로 했었는데 프로젝트를 진행하다보니 기능을 추가하면 더 좋을 것 같다는 교수님 말씀을 듣고 이벤트 메뉴를 추가하고 댓글을 작성 삭제하는 기능과 관리자 페이지를 추가해서 회원 삭제와 회원의 댓글을 삭제, 이벤트를 등록하고 삭제가 가능하도록 구현을 했는데, 처음엔 못 할 것 같다고 했었는데 이것저것 찾아보며 해보니 다 구현을 하게 됐습니다. 다 구현해내고 나니 그 기능들이 많이 어렵거나 힘든게 아니였구나라는 생각이 들었지만 막상 완성된 사이트를 보니 남들이 하지않는 특별한 기능은 없는 것 같다는 생각도 들어서 아쉽기도 합니다.

**소감**<br>
팀프로젝트를 한다는 것에 대한 부담감도 느꼈고 아직 많이 부족해서 한참 더 공부를 해야겠다는 생각도 들었습니다.필요한 기능이라고 얘기하면 구현해내는 팀장님, 디자인, 퍼블리싱 등 모두 잘 하는 정선씨, 모두 든든하고 대단했어요.

<br>

### 🦽 김환

**자체평가**<br>
퍼블리싱과 프론트 엔드를 담당하였으나 퍼블리싱에서 막히는 부분이 많아서 다른 팀원분들이 도와주시게 되고 프론트 엔드 역할도 다른 팀원분이 여유가 생기시면 작업을 나눠서 같이 하게 되니 제가 담당 한 분야의 비중이 그렇게 크게 느껴지지 않아 개인적인 역량이 부족하다고 느낀 프로젝트였습니다. 프    로 젝트 진행 부분에서는 부족한 부분이 보이면 그걸 수정하며 새로 만드는 일이 많았던 거 같습니다. 결과적으로 반응형 홈페이지, 소셜 로그인, api 활용, crud 기능이 모두 사용되는 홈페이지를 만들려다 보니 처음 기획보다 더 많은 기능이 추가되어 그걸 다시 수정하는 일도 생겨 일이 많아졌지만 잘 구현    된 거 같아 만족스럽습니다. 다음 프로젝트 때는 프로젝트 기획을 좀 더 꼼꼼하게 만들어 중간에 수정하는 일이 적었으면 하는 생각이 들었습니다.

**소감**<br>
일정이 빡빡하고 처음 하는 프로젝트라 정신없이 시작되었으나 생각보다 재밌게 수행하게 되어 만족스럽고 매일 회의를 하며 작업 조율을 하다 보니 팀원들과 조율하지 않으면 진행할 수 없는 부분이 많다는 걸 느꼈습니다. 다음 프로젝트에서 더 좋은 모습을 보여드리고 싶습니다.

<br>

### 👀 박정선

**자체평가**<br>
기획단계에서 좀더 세밀하게 팀원들과 이야기하고 디자인을 시작 했어야 하는데 그러지 못했습니다. 그래서 프로젝트 후반에 수정하고 추가한 부분들이 있어서 진행이 순탄하지 못했던 것 같습니다. 그리고 디자인 관련해서는 사용자가 사용하는 기기마다 보이는 화면을 좀더 깔끔하게 만들 수 있었지 않을까라는 아쉬움도 남지만, 팀원들이 UI/UX 전반에 걸쳐 저를 믿고 맡겨 주셨기에 끝까지 완성하지 않았나 싶습니다. 그리고 디자인이 생각보다 시간이 오래 걸리게 되어 퍼블리싱쪽으로 많은 도움을 드리지못했는데 다음 프로젝트때에는 가능하면 좀더 빠르게 끝내 퍼블리싱에 많은 기여를 하고싶습니다. 

**소감**<br>
한달에 프로젝트를 하나씩 한다고 했을 때 완성할 수 있을까라는 생각을 했었습니다. 수업을 받으면서 개발하는 것에 많은 부족함을 느끼고있었는데 팀프로젝트를 하면서 제가 부족한 부분을 우리 팀원들이 너무 잘 채워 주셔서 끝까지 완성할 수 있었던 것 같습니다.

<br>


