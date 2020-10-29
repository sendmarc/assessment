import React from 'react';
import { Link } from 'react-router-dom';

export default function Error404() {
  return (
    <div>
      <br /><br />
      <div className="alert alert-danger">
        404 Page Not Found. <Link to="/" className="alert-link" style={{ float: "right" }}>Back to home </Link>
      </div>
    </div>
  );
}
