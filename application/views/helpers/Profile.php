<?php
class Zend_View_Helper_Profile extends Zend_View_Helper_Abstract {
	public function Profile() {
		return "
				<ul>
					<li><a href='/profile/photo' class='link'><img
						src='/images/icons/user.png' class='icon' />更新个人头像</a></li>
					<li><a href='/member/edit' class='link'><img
						src='/images/icons/vcard.png' class='icon' />编辑会员信息</a></li>
                                        <li><a href='/profile/message' class='link'><img
						src='/images/icons/vcard.png' class='icon' />查看短信</a></li>
					<li><a href='/profile/password' class='link'><img
						src='/images/icons/lock_edit.png' class='icon' />更改密码 </a></li>
				   <li><a href='/profile/upload' class='link'><img
						src='/images/icons/lock_edit.png' class='icon' />上传图片</a></li>
				  <li><a href='/profile/remove' class='link'><img
						src='/images/icons/lock_edit.png' class='icon' />删除会员档案 </a></li>
				</ul>";
	}
}
