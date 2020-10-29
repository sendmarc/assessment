import React, { useCallback, useEffect, useState } from 'react';
import axios from 'axios';
import { Link } from 'react-router-dom';
import Pagination from "react-js-pagination";
import SuccessAlert from './SuccessAlert';
import ErrorAlert from './ErrorAlert';


export default function Listing() {
  const [alertMessage, setAlertMessage] = useState();
  const [paginatedTasks, setPaginatedTasks] = useState();
  const [itemsCountPerPage, setItemsCountPerPage] = useState();
  const [totalItemsCount, setTotalItemsCount] = useState(0);
  const [activePage, setActivePage] = useState();
  const [pageRangeDisplayed] = useState(3);


  useEffect(() => {
    axios.get('http://localhost:8080/api/tasks')
      .then(response => {
        const { data } = response;

        setPaginatedTasks(data.data);
        setItemsCountPerPage(data.per_page);
        setTotalItemsCount(data.total);
        setActivePage(data.current_page);
      });
  }, []);

  const handlePageChange = useCallback((pageNumber) => {
    axios.get('http://localhost:8080/api/tasks?page=' + pageNumber)
      .then(response => {
        const { data } = response;

        setPaginatedTasks(data.data);
        setItemsCountPerPage(data.per_page);
        setTotalItemsCount(data.total);
        setActivePage(data.current_page);
      });
  }, []);

  const onDelete = useCallback(taskId => {
    axios.delete('http://localhost:8080/api/tasks/delete/' + taskId)
      .then(response => {
        if (response.status) {
          handlePageChange(activePage);
          setAlertMessage("success");
        } else
          setAlertMessage("error");
      }).catch(() => {
        setAlertMessage("error");
      })
  }, [])

  const onTick = useCallback(() => {
    axios.get('http://localhost:8080/api/list/tick')
      .then(response => {
        if (response.status) {
          handlePageChange(activePage);
          setAlertMessage("success");
        } else
          setAlertMessage("error");
      }).catch(() => {
        setAlertMessage("error");
      })
  }, [])

  return (
    <div>
      {alertMessage == "success" ? <SuccessAlert message={"Success!."} /> : null}
      {alertMessage == "error" ? <ErrorAlert message={"Error occurred while completing your request."} /> : null}

      <table className="table table-striped table-hover table-sm">
        <thead className="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Task Name</th>
            <th scope="col">Priority</th>
            <th scope="col">Due In</th>
            <th scope="col">Created At</th>
            <th scope="col">Updated At</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          {
            paginatedTasks && paginatedTasks.map(task => {
              return (
                <tr key={task.id}>
                  <th scope="row">{task.id}</th>
                  <td>{task.name}</td>
                  <td>{task.priority}</td>
                  <td>{task.dueIn}</td>
                  <td>{task.created_at}</td>
                  <td>{task.updated_at}</td>
                  <td>
                    <Link to={`/tasks/edit/${task.id}`}>Edit</Link>
                    {' '} | {' '}
                    <a href="#" onClick={() => onDelete(task.id)}>Delete</a>
                  </td>
                </tr>
              )
            })
          }
        </tbody>
        <tfoot>
          <tr>
            <td colSpan="3" style={{ paddingTop: '20px' }}>
              <button type="submit" className="btn btn-primary btn-block" onClick={() => onTick()}>Tick</button>
            </td>
            <td colSpan="4" style={{ paddingTop: '20px' }}>
              <div className="d-flex justify-content-end">
                <Pagination
                  activePage={activePage}
                  itemsCountPerPage={itemsCountPerPage}
                  totalItemsCount={totalItemsCount}
                  pageRangeDisplayed={pageRangeDisplayed}
                  onChange={handlePageChange}
                  itemClass='page-item'
                  linkClass='page-link'
                />
              </div>
            </td>
          </tr>
        </tfoot>
      </table >

    </div >
  );
}

