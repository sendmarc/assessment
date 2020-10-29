import React from 'react';
import PropTypes from "prop-types";


export default function ErrorAlert(props) {
  const { message } = props;
  return (
    <div className="alert alert-danger" role="alert" style={{ marginTop: '10px' }}>
      {message}
    </div>
  );
}

ErrorAlert.propTypes = {
  message: PropTypes.string,
};
