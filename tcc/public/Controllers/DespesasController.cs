using System;
using System.Collections.Generic;
using System.Data;
using System.Data.Entity;
using System.Linq;
using System.Net;
using System.Web;
using System.Web.Mvc;
using Gestão_de_gasto.Models;

namespace Gestão_de_gasto.Controllers
{
    public class DespesasController : Controller
    {
        private DespesasContext db = new DespesasContext();

        // GET: Despesas
        public ActionResult Index()
        {
            return View(db.Despesas.ToList());
        }

        // GET: Despesas/Details/5
        public ActionResult Details(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            Despesas despesas = db.Despesas.Find(id);
            if (despesas == null)
            {
                return HttpNotFound();
            }
            return View(despesas);
        }

        // GET: Despesas/Create
        public ActionResult Create()
        {
            return View();
        }

        // POST: Despesas/Create
        // Para proteger-se contra ataques de excesso de postagem, ative as propriedades específicas às quais deseja se associar. 
        // Para obter mais detalhes, confira https://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Create([Bind(Include = "Id,servico,valor,local,data,formaDePagamento,viagem")] Despesas despesas)
        {
            if (ModelState.IsValid)
            {
                db.Despesas.Add(despesas);
                db.SaveChanges();
                return RedirectToAction("Index");
            }

            return View(despesas);
        }

        // GET: Despesas/Edit/5
        public ActionResult Edit(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            Despesas despesas = db.Despesas.Find(id);
            if (despesas == null)
            {
                return HttpNotFound();
            }
            return View(despesas);
        }

        // POST: Despesas/Edit/5
        // Para proteger-se contra ataques de excesso de postagem, ative as propriedades específicas às quais deseja se associar. 
        // Para obter mais detalhes, confira https://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Edit([Bind(Include = "Id,servico,valor,local,data,formaDePagamento,viagem")] Despesas despesas)
        {
            if (ModelState.IsValid)
            {
                db.Entry(despesas).State = EntityState.Modified;
                db.SaveChanges();
                return RedirectToAction("Index");
            }
            return View(despesas);
        }

        // GET: Despesas/Delete/5
        public ActionResult Delete(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            Despesas despesas = db.Despesas.Find(id);
            if (despesas == null)
            {
                return HttpNotFound();
            }
            return View(despesas);
        }

        // POST: Despesas/Delete/5
        [HttpPost, ActionName("Delete")]
        [ValidateAntiForgeryToken]
        public ActionResult DeleteConfirmed(int id)
        {
            Despesas despesas = db.Despesas.Find(id);
            db.Despesas.Remove(despesas);
            db.SaveChanges();
            return RedirectToAction("Index");
        }

        protected override void Dispose(bool disposing)
        {
            if (disposing)
            {
                db.Dispose();
            }
            base.Dispose(disposing);
        }
    }
}
