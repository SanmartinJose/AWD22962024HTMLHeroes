import React from 'react';

const Pagination = ({ currentPage, totalPages, onPageChange }) => {
    return (
        <nav>
            <ul className="pagination justify-content-center">
                <li className={`page-item ${currentPage === 1 ? 'disabled' : ''}`}>
                    <button
                        className="page-link"
                        onClick={() => onPageChange(currentPage - 1)}
                    >
                        &laquo;
                    </button>
                </li>
                {[...Array(totalPages).keys()].map((page) => (
                    <li
                        key={page + 1}
                        className={`page-item ${currentPage === page + 1 ? 'active' : ''}`}
                    >
                        <button
                            className="page-link"
                            onClick={() => onPageChange(page + 1)}
                        >
                            {page + 1}
                        </button>
                    </li>
                ))}
                <li className={`page-item ${currentPage === totalPages ? 'disabled' : ''}`}>
                    <button
                        className="page-link"
                        onClick={() => onPageChange(currentPage + 1)}
                    >
                        &raquo;
                    </button>
                </li>
            </ul>
        </nav>
    );
};

export default Pagination;