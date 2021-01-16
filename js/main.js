import {LoadAdminSubpage} from "./modules/loadAdminSubpage.js";
import {ChangeCSSColor} from "./modules/changeCSSColor.js";

let loadSubpage = new LoadAdminSubpage('admin_welcome.php');
let changeAdminColor = new ChangeCSSColor("white");

//'
window.loadSubpage = loadSubpage;
window.changeAdminColor = changeAdminColor;