using System;
using System.Collections;
using System.Collections.Generic;
using System.Text;
namespace Letterwoorden
{
    #region Woordenlijst
    public class Woordenlijst
    {
        #region Member Variables
        protected string _woord;
        #endregion
        #region Constructors
        public Woordenlijst() { }
        public Woordenlijst(string woord)
        {
            this._woord=woord;
        }
        #endregion
        #region Public Properties
        public virtual string Woord
        {
            get {return _woord;}
            set {_woord=value;}
        }
        #endregion
    }
    #endregion
}