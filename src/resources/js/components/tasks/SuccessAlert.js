import React from 'react';
import PropTypes from "prop-types";


export default function SuccessAlert(props) {
  const { message } = props;
  return (
    <div className="alert alert-success" role="alert" style={{ marginTop: '10px' }}>
      {message}
    </div>
  );
}

SuccessAlert.propTypes = {
  message: PropTypes.string,
};
