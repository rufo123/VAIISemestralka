import {LoadAdminSubpage} from "./modules/loadAdminSubpage.js";
import {ChangeCSSColor} from "./modules/changeCSSColor.js";
import {AdminBlogResizer} from "./modules/adminBlogResizer.js";
import {AjaxDeletePost} from "./modules/ajaxDeletePost.js";
import {AjaxSwitchBlogSubpages} from "./modules/ajaxSwitchBlogSubpages.js";
import {AjaxMoreBlogPosts} from "./modules/ajaxMoreBlogPosts.js";
import {AjaxDeleteUser} from "./modules/ajaxDeleteUser.js";

let loadSubpage = new LoadAdminSubpage('admin_welcome.php');
let changeAdminColor = new ChangeCSSColor("rebeccapurple");
let adminBlogResizer = new AdminBlogResizer();
let ajaxDeletePost = new AjaxDeletePost();
let ajaxSwitchBlogSubpages = new AjaxSwitchBlogSubpages();
let ajaxMoreBlogPosts = new AjaxMoreBlogPosts();
let ajaxDeleteUser = new AjaxDeleteUser();

window.ajaxDeletePost = ajaxDeletePost;
window.loadSubpage = loadSubpage;
window.changeAdminColor = changeAdminColor;
window.adminBlogResizer = adminBlogResizer;
window.ajaxSwitchBlogSubpages = ajaxSwitchBlogSubpages;
window.ajaxMoreBlogPosts = ajaxMoreBlogPosts;
window.ajaxDeleteUser = ajaxDeleteUser;