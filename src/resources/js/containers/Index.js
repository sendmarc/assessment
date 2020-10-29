import React from 'react';
import Header from '../components/Header';
import Tasks from '../components/tasks/Index';
import Footer from '../components/Footer';
import Error404 from '../components/Error404';

import { BrowserRouter as Router, Route, Switch } from 'react-router-dom';


export default function Index() {
  return (
    <Router>
      <div className="container">
        <Header />

        <div className='row'>
          <div className='col-md-12'>
            <Switch>
              <Route exact path='/tasks' component={Tasks} />
              <Route exact path="/tasks/add" component={Tasks} />
              <Route exact path="/tasks/edit/:id" component={Tasks} />

              <Route exact path="/*" component={Error404} />
            </Switch>
          </div>
        </div>

        <Footer />
      </div>
    </Router>
  );
}
