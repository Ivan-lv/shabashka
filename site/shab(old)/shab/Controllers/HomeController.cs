using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using shab.Models;


namespace shab.Controllers
{
    public class HomeController : Controller
    {
        // GET: Home
        public ActionResult Index()
        {
            OrderContext db = new OrderContext();

            IEnumerable<Order> orders = db.Orders;
            ViewBag.Orders = orders;
            return View();
        }
    }
}