import React, { useState } from 'react';

import { Link, Route } from 'react-router-dom';
import Add from "./Add";
import Listing from "./Listing";
import Edit from "./Edit";

export default function Tasks() {
  const [activeLink, setActiveLink] = useState(true);

  return (
    <div>
      <nav className="navbar navbar-dark bg-dark">
        <Link to="/tasks" onClick={() => setActiveLink(true)}>
          <button type="button" className="btn btn-secondary">Listing</button>
        </Link>

        {activeLink &&
          <Link to="/tasks/add" onClick={() => setActiveLink(false)}>
            <button type="button" className="btn btn-success">Add</button>
          </Link>
        }
      </nav>

      <Route exact path='/' component={Listing} />
      <Route exact path="/tasks" component={Listing} />
      <Route exact path="/tasks/add" component={Add} />
      <Route exact path="/tasks/edit/:id" component={Edit} />
    </div >
  );
}
