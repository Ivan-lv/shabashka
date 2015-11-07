using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace shab.Models
{
    public class Order
    {
        public int Id { get; set; }
        public string Name { get; set; }
        public int price { get; set; }
        public DateTime PublicDate { get; set; }
        public DateTime EndDate { get; set; }
    }
}