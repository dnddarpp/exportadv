using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

namespace ADLogin
{
    public partial class login : System.Web.UI.Page
    {
        protected void Page_Load(object sender, EventArgs e)
        {

        }

        protected void Button1_Click(object sender, EventArgs e)
        {
            

            ServiceReference1.MaintainADClient m_ad = new ServiceReference1.MaintainADClient();
            bool gofeed = m_ad.CheckAccPwd(account.Text, password.Text, "exportadv.com.tw", "eCFB80&0ctra");
            //TextBox1.Text = gofeed.ToString();
            if (gofeed == true)
            {
                Session["mng_mid"] = account.Text;
                Response.Write("<Script language='JavaScript'>alert('登入成功'); localStorage.setItem(\"ADaccount\",\""+account.Text+"\");location.href=\"https://exportadv.com.tw/admin/newslist\"; </Script>");
            }
            else
            {                
                Response.Write("<Script language='JavaScript'>alert('帳號密碼錯誤'); localStorage.removeItem(\"ADaccount\");</Script>");
            }
                        
            
        }
    }
}