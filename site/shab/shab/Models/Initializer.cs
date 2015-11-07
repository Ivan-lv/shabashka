using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Data.Entity;

namespace shab.Models
{
    public class Initializer : DropCreateDatabaseAlways<OrderContext>
    {
        protected override void Seed(OrderContext db)
        {
            db.Orders.Add(new Order { Name = "Война и мир", price = 220 });
            db.Orders.Add(new Order { Name = "Отцы и дети", price = 180 });
            base.Seed(db);
        }
    }
}